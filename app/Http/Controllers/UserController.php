<?php

namespace App\Http\Controllers;

use Rinvex\Country\Country;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
    public function index()
    {
        return redirect('/u/4');
    }

    public function login()
    {
        if (!auth()->check()) {
            return view('user.login');
        } else {
            return redirect('/u/' . Auth::user()->id);
        }
    }

    public function loginProcess(Request $request)
    {
        $data = [
            'name' => $request->input('username'),
            'pw_bcrypt' => md5($request->input('pw_bcrypt'))
        ];

        $hash = DB::table('users')->select('pw_bcrypt')
            ->where('name', $data['name'])
            ->first();
        $user = User::where('name', $data['name'])->first();

        if ($user && password_verify($data['pw_bcrypt'], $user->pw_bcrypt)) {
            Auth::login($user);
            return redirect('/u/' . Auth::user()->id);
        } else {
            return redirect('/login')->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        Auth::logout(); // Logout the user
        return redirect()->back()->with('success', 'You have been logged out successfully.');
    }

    public function gnetotUpload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
    }

    public function profile(request $request, $id)
    {
        # Check if user exists
        $user = User::find($id);
        if (!$user) {
            return redirect('/')->with('error', 'User not found');
        } else {

            if ($user && $user->country) {
                $user->flag_url = $this->getTwemojiFlagUrl($user->country);
                $user->country_name = country($user->country)->getOfficialName();
            }

            # Mode Check
            $mode = $request->input('mode', 0);
            $rx = $request->input('rx', 0);

            $combinedMode = $rx + $mode;

            # Get the user's Stats
            $userProfile = DB::table('stats')
                ->selectRaw('rscore AS `Ranked Score`,
                            acc AS `Hit Accuracy`,
                            plays AS `Play Count`,
                            tscore AS `Total Score`,
                            total_hits AS `Total Hits`,
                            max_combo AS `Max Combo`,
                            replay_views AS `Replays Watched by Others`,
                            pp AS `PP`,
                            playtime AS `Total Play Time`,
                            xh_count AS `XH Count`,
                            x_count AS `X Count`,
                            sh_count AS `SH Count`,
                            s_count AS `S Count`,
                            a_count AS `A Count`')
                ->where('id', $id)
                ->where('mode', $combinedMode)
                ->first();

            $countryCode = DB::table('users')->where('id', $id)->value('country');
            $globalRank = DB::table('stats')
                ->where('mode', $combinedMode)
                ->where('pp', '>', $userProfile->PP ?? 0)
                ->count() + 1;

            $countryRank = DB::table('stats')
                ->join('users', 'users.id', '=', 'stats.id')
                ->where('stats.mode', $combinedMode)
                ->where('users.country', $countryCode)
                ->where('stats.pp', '>', $userProfile->PP ?? 0)
                ->count() + 1;

            # Get the user's first place scores
            if ($rx != 0) {
                $firstPlaces = DB::table('scores')
                    ->join('maps', 'scores.map_md5', '=', 'maps.md5')
                    ->join(
                        DB::raw('(SELECT 
                        map_md5, 
                        MAX(pp) as max_pp 
                      FROM scores 
                      WHERE mode = ' . $combinedMode . ' 
                        AND status = 2
                      GROUP BY map_md5) as max_pps'),
                        function ($join) {
                            $join->on('scores.map_md5', '=', 'max_pps.map_md5')
                                ->on('scores.pp', '=', 'max_pps.max_pp');
                        }
                    )
                    ->select(
                        'scores.id',
                        'scores.grade',
                        'scores.userid',
                        'scores.score',
                        'scores.acc',
                        'scores.pp',
                        'scores.mods',
                        'scores.play_time',
                        'maps.id as map_id',
                        'maps.title as map_title',
                        'maps.status as map_status',
                        'maps.artist as map_artist',
                        'maps.version as map_version'
                    )
                    ->where('maps.status', '!=', 0)
                    ->where('scores.userid', $id)
                    ->where('scores.mode', $combinedMode)
                    ->orderBy('scores.play_time', 'desc')
                    ->take(10)
                    ->get()
                    ->map(function ($pp) {
                        $pp->pp = (int)$pp->pp;
                        return $pp;
                    });
            } else {
                $firstPlaces = DB::table('scores')
                    ->join('maps', 'scores.map_md5', '=', 'maps.md5')
                    ->join(
                        DB::raw('(SELECT 
                        map_md5, 
                        MAX(score) as max_score 
                      FROM scores 
                      WHERE mode = ' . $mode . ' 
                        AND status = 2
                      GROUP BY map_md5) as max_scores'),
                        function ($join) {
                            $join->on('scores.map_md5', '=', 'max_scores.map_md5')
                                ->on('scores.score', '=', 'max_scores.max_score');
                        }
                    )
                    ->select(
                        'scores.id',
                        'scores.grade',
                        'scores.userid',
                        'scores.score',
                        'scores.acc',
                        'scores.pp',
                        'scores.mods',
                        'scores.play_time',
                        'maps.id as map_id',
                        'maps.title as map_title',
                        'maps.status as map_status',
                        'maps.artist as map_artist',
                        'maps.version as map_version'
                    )
                    ->where('maps.status', '!=', 0)
                    ->where('scores.userid', $id)
                    ->where('scores.mode', $mode)
                    ->orderBy('scores.play_time', 'desc')
                    ->take(10)
                    ->get()
                    ->map(function ($pp) {
                        $pp->pp = (int)$pp->pp;
                        return $pp;
                    });
            }

            $firstPlaces->transform(function ($play) {
                $play->mods_list = $this->decodeMods($play->mods);
                return $play;
            });

            # Get the user's top plays
            $topPlays = DB::table('scores')
                ->join('maps', 'scores.map_md5', '=', 'maps.md5')
                ->select('scores.*', 'maps.id as map_id', 'maps.title as map_title', 'maps.artist as map_artist', 'maps.version as map_version', 'maps.status as map_status')
                ->where('maps.status', '2')
                ->where('scores.status', '2')
                ->where('scores.mode', $rx + $mode)
                ->where('scores.userid', $id)
                ->orderBy('pp', 'desc')
                ->take(10)
                ->get()
                ->map(function ($pp) {
                    $pp->pp = (int)$pp->pp;
                    return $pp;
                });

            $topPlays->transform(function ($play) {
                $play->mods_list = $this->decodeMods($play->mods);
                return $play;
            });

            # Get the user's recent plays
            $recentPlays = DB::table('scores')
                ->join('maps', 'scores.map_md5', '=', 'maps.md5')
                ->select('scores.*', 'maps.id as map_id', 'maps.title as map_title', 'maps.artist as map_artist', 'maps.version as map_version', 'maps.status as map_status')
                ->where('userid', $id)
                ->where('scores.mode', $rx + $mode)
                ->where('scores.play_time', '>=', now()->subDay())
                ->orderBy('play_time', 'desc')
                ->take(10)
                ->get()->map(function ($pp) {
                    $pp->pp = (int)$pp->pp;
                    return $pp;
                });

            $recentPlays->transform(function ($play) {
                $play->mods_list = $this->decodeMods($play->mods);
                return $play;
            });
        }

        return view('user.profile', [
            'user' => $user,
            'first_places' => $firstPlaces,
            'top_plays' => $topPlays,
            'recent_plays' => $recentPlays,
            'mode' => $mode,
            'rx' => $rx,
            'user_profile' => $userProfile,
            'global_rank' => $globalRank,
            'country_rank' => $countryRank,
        ]);
    }

    public function editProfile($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        } else if ($user != Auth::user()) {
            return redirect()->back()->with('error', 'You are not authorized to edit this profile');
        } else {
            if ($user && $user->country) {
                $user->country = country($user->country)->getOfficialName();
            }

            return view('user.edit', [
                'user' => $user
            ]);
        }
    }

    public function editProcess(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $response = ['success' => true];

        // Simpan konten halaman pengguna
        if ($request->has('userpage-content')) {
            $user->userpage_content = $request->input('userpage-content');
            $user->save();
        }

        // Simpan avatar
        if ($request->hasFile('avatar')) {
            $avatarPath = 'avatars/' . $user->id . '.png';
            Storage::disk('public')->put($avatarPath, file_get_contents($request->file('avatar')));
        }

        // Simpan background
        if ($request->hasFile('background')) {
            $bgPath = 'backgrounds/' . $user->id . '.png';
            Storage::disk('public')->put($bgPath, file_get_contents($request->file('background')));
        }

        // Verifikasi apakah file berhasil disimpan
        if ($request->hasFile('avatar')) {
            $avatarPath = 'avatars/' . $user->id . '.png';
            if (Storage::disk('public')->exists($avatarPath)) {
                $response['avatar'] = Storage::url($avatarPath);
            } else {
                return response()->json(['success' => false, 'error' => 'Avatar gagal disimpan'], 500);
            }
        }

        if ($request->hasFile('background')) {
            $bgPath = 'backgrounds/' . $user->id . '.png';
            if (Storage::disk('public')->exists($bgPath)) {
                $response['background'] = Storage::url($bgPath);
            } else {
                return response()->json(['success' => false, 'error' => 'Background gagal disimpan'], 500);
            }
        }

        return response()->json($response);
    }

    private function decodeMods($modsValue)
    {
        $mods = [];
        $modsValue = (int)$modsValue;

        if ($modsValue & 512) { // Nightcore (512 + 64)
            $mods[] = 'Nightcore';
            $modsValue &= ~(512 | 64);
        }
        if ($modsValue & 16384) { // Perfect (16384 + 32)
            $mods[] = 'Perfect';
            $modsValue &= ~(16384 | 32);
        }

        $modsMap = [
            0 => 'None',
            1 => 'No Fail',
            2 => 'Easy',
            4 => 'TouchDevice',
            8 => 'Hidden',
            16 => 'HardRock',
            32 => 'SuddenDeath',
            64 => 'DoubleTime',
            128 => 'Relax',
            256 => 'HalfTime',
            1024 => 'Flashlight',
            2048 => 'Autoplay',
            4096 => 'SpunOut',
            8192 => 'Autopilot',
            32768 => 'Key4',
            65536 => 'Key5',
            131072 => 'Key6',
            262144 => 'Key7',
            524288 => 'Key8',
            1048576 => 'Fade In',
            2097152 => 'Random',
            4194304 => 'Cinema',
            8388608 => 'Target',
            16777216 => 'Key9',
            33554432 => 'KeyCoop',
            67108864 => 'Key1',
            134217728 => 'Key3',
            268435456 => 'Key2',
            536870912 => 'ScoreV2',
            1073741824 => 'LastMod',
        ];

        foreach ($modsMap as $bit => $name) {
            if ($modsValue & $bit) {
                $mods[] = $name;
            }
        }

        return !empty($mods) ? $mods : ['None'];
    }

    private function getTwemojiFlagUrl(string $countryCode): ?string
    {
        $countryCode = strtoupper($countryCode);

        if (strlen($countryCode) !== 2 || !ctype_alpha($countryCode)) {
            return null;
        }

        $codepoints = [
            'A' => '1f1e6',
            'B' => '1f1e7',
            'C' => '1f1e8',
            'D' => '1f1e9',
            'E' => '1f1ea',
            'F' => '1f1eb',
            'G' => '1f1ec',
            'H' => '1f1ed',
            'I' => '1f1ee',
            'J' => '1f1ef',
            'K' => '1f1f0',
            'L' => '1f1f1',
            'M' => '1f1f2',
            'N' => '1f1f3',
            'O' => '1f1f4',
            'P' => '1f1f5',
            'Q' => '1f1f6',
            'R' => '1f1f7',
            'S' => '1f1f8',
            'T' => '1f1f9',
            'U' => '1f1fa',
            'V' => '1f1fb',
            'W' => '1f1fc',
            'X' => '1f1fd',
            'Y' => '1f1fe',
            'Z' => '1f1ff'
        ];

        $chars = str_split($countryCode);
        $first = $codepoints[$chars[0]] ?? null;
        $second = $codepoints[$chars[1]] ?? null;

        if (!$first || !$second) {
            return null;
        }

        return "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/{$first}-{$second}.svg";
    }
}

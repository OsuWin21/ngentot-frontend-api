<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect('/admin/login');
        } else {
            $adminData = DB::table('users')->select('*')
                ->get();

            $totalUsers = DB::table('users')->where('id', '>', '1')
                ->count();

            $totalPP = DB::table('stats')->select('*')->where('id', '>', '1')->sum('pp');

            $currentYear = now()->year;

            $regDataChart = DB::table('users')->select(DB::raw('COUNT(*) as count, DATE_FORMAT(FROM_UNIXTIME(creation_time), "%m") as month'))
                ->where('id', '>', 1)
                ->whereRaw('YEAR(FROM_UNIXTIME(creation_time)) = ?', [$currentYear])
                ->groupBy(DB::raw('MONTH(FROM_UNIXTIME(creation_time))'), 'creation_time')
                ->orderBy('month', 'asc')
                ->get();


            $loginDataChart = DB::table('ingame_logins')->select('datetime')
                ->whereYear('datetime', $currentYear)
                ->get();
            $recentPlays = DB::table('scores')->select('scores.*', 'users.name as username', 'maps.filename')
                ->join('maps', 'map_md5', '=', 'maps.md5')
                ->join('users', 'userid', '=', 'users.id')
                ->where('scores.userid', '>', '1')
                ->where('scores.grade', '!=', 'F')
                ->skip(0)
                ->take(5)
                ->orderBy('play_time', 'desc')
                ->get()
                ->map(function ($pp) {
                    $pp->pp = (int)$pp->pp; // Converting 'pp' to integer
                    return $pp;
                });

            //Register Data for Dashboard Charts
            $regGroupedData = $regDataChart->groupBy(function ($item) {
                return Carbon::createFromDate($item->creation_time ?? 0)->format('m');
            })->map(function ($group) {
                return count($group);
            });

            $regChartData = $regGroupedData->values()->toArray();

            //Login Data for Dashboard Charts
            $loginGroupedData = $loginDataChart->groupBy(function ($item) {
                return Carbon::createFromDate($item->datetime ?? 0)->format('m');
            })->map(function ($group) {
                return count($group);
            });

            $loginChartData = $loginGroupedData->values()->toArray();

            return view('admin.index', [
                'admin_data' => $adminData,
                'total_users' => $totalUsers,
                'total_pp' => $totalPP,
                'recent_plays' => $recentPlays,
                'reg_data' => $regChartData,
                'login_data' => $loginChartData
            ]);
        }
    }

    public function getPlayerCount()
    {
        $response = Http::get('https://api.randomflies.my.id/v1/get_player_count');

        if ($response->successful()) {
            $data = $response->json();

            return response()->json([
                'status' => 'success',
                'counts' => [
                    'online' => $data['counts']['online'],
                    'total' => $data['counts']['total'],
                ],
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch player count.',
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login()
    {
        if (!auth()->check()) {
            return view('admin.login');
        } else {
            return redirect('/admin/dashboard');
        }
    }

    public function loginProcess(Request $request)
    {
        $data = [
            'name' => $request->input('username'),
            'pw_bcrypt' => md5($request->input('pw_bcrypt'))
        ];

        // See the password_hash() example to see where this came from.
        $hash = DB::table('users')->select('pw_bcrypt')
                                  ->where('name', $data['name'])
                                  ->first();
        $user = User::where('name', $data['name'])->first();

        if ($user && password_verify($data['pw_bcrypt'], $user->pw_bcrypt)) {
            Auth::login($user);
            return redirect('/admin/dashboard');
        } else {
            return redirect('/admin/login')->with('error', 'Invalid username or password');;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function register()
    {
        $data['titles'] = 'Register';
        return view('auth.registration', $data);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:tb_regis',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
        ]);

        $user = new User([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $user->save();
        return redirect()->route('login')->with('success', 'Registration Success');
    }

    public function login()
    {
        $data['title'] = 'Login';
        return view('auth.login', $data);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' =>'required',
            'password' => 'required',
        ]);

        if(Auth::attempt(['username'=>$request->username, 'password'=>$request->password])){
            $request->session()->regenerate();
            return redirect()->intended('home');
        }
        return back()->withErrors('password', 'Wrong username or password');
    }
}

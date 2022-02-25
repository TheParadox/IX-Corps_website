<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if(!auth()->attempt($request->only('name', 'password'), $request->remember)){
            return back()->with('status', 'Invalid login details');
        }

        return redirect()->route('member', ['memberID' => auth()->user()->id]);
    }

    public function logout(Request $request)
    {
        auth()->logout();

        return redirect()->route('home');
    }
}

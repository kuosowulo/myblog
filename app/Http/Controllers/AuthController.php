<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showlogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request = $request->all();

        $attempt = Auth::attempt(
            [
                'email' => $request['email'],
                'password' => $request['password']
            ], true
        );

        if ($attempt) {
            return redirect('/index');
        } else {
            dd('oops');
        }
    }
}

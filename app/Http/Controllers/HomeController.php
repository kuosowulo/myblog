<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        
        return view('index');
    }

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
            ]
        );

        if ($attempt) {
            return redirect('/index');
        } else {
            dd('oops');
        }
    }
}

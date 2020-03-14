<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index() 
    {
        return view('index');
    }

    public function viewPost()
    {
        return view('post');
    }

    public function viewContact()
    {
        return view('contact');
    }

    public function viewAbout()
    {
        return view('about');
    }
}

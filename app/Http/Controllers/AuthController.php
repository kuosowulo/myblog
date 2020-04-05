<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\blogServices;

class AuthController extends Controller
{
    public function __construct(blogServices $blogService)
    {
        $this->blog = $blogService;
    }

    public function showlogin()
    {
        if(Auth::check() && Auth::viaRemember()) {
            return redirect('/index');
        } else {
            return view('loginPage');
        }
    }

    public function login(Request $request)
    {
        $request = $request->all();
        $IsRemember = false;

        if(isset($request['remember-me'])) {
            $IsRemember = true;
        }

        $attempt = Auth::attempt(
            [
                'email' => $request['email'],
                'password' => $request['password']
            ], $IsRemember
        );

        if ($attempt) {
            return redirect('/index');
        } else {
            dd('oops');
        }
    }

    public function index()
    {
        $articles = $this->blog->getAllPost();
        
        return view('index', compact('articles'));
    }

    public function viewPost(Request $request)
    {
        $id = $request->all()['id'];
        $article = $this->blog->getPostById($id);

        return view('post', compact('article'));
    }
}

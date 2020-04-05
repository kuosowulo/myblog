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
        return view('loginPage');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\blogServices;


class HomeController extends Controller
{
    public function __construct(blogServices $blogService)
    {
        $this->blog = $blogService;
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

    public function viewEditPost(Request $request)
    {
        $id = $request->all()['id'];
        $article = $this->blog->getPostById($id);
        
        return view('postForm', compact('article'));
    }

    public function newPost(Request $request)
    {
        $request = $request->all();

        $author = Auth::user()->id;
        $title = $request['title'];
        $subtitle = $request['subtitle'];
        $content = $request['editordata'];

        if ($this->blog->newPost($author, $title, $subtitle, $content)){
            return redirect('/index');
        } else {
            dd('fail');
        }
    }

    public function editPost($id, Request $request)
    {
        $request = $request->all();
        $title = $request['title'];
        $subtitle = $request['subtitle'];
        $content = $request['editordata'];
        
        if ($this->blog->editPost($id, $title, $subtitle, $content)){
            return redirect('/index');
        } else {
            dd('fail');
        }
        
    }

    public function uploadImage(Request $request)
    {
        dump($request);
        dd();
    }

    public function getPostForm()
    {
        return view('postForm');
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

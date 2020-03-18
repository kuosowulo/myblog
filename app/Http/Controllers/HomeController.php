<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\articles;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index()
    {
        $articles = articles::with('users')->get();

        return view('index', compact('articles'));
    }

    public function viewPost(Request $request)
    {
        $id = $request->all()['id'];
        $article = articles::where('id', $id)->first();
        
        return view('post', compact('article'));
    }

    public function newPost(Request $request)
    {
        $request = $request->all();
        $user = Auth::user();
        
        $newPost = new articles();
        $newPost->author = $user->id;
        $newPost->title = $request['title'];
        $newPost->subtitle = $request['subtitle'];
        $newPost->content = $request['editordata'];
        $newPost->date = Carbon::today()->toDateString();
        $newPost->save();

        return redirect('/index');
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

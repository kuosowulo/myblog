<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
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

    public function deletePost(Request $request)
    {
        $id = $request->all()['id'];

        if ($this->blog->deletePost($id)) {
            return redirect('/index');
        } else {
            dd('fail');
        }
    }

    public function uploadFile(Request $request)
    {
        $user_id = Auth::user()->id;
        
        if($request->hasFile('file') && $user_id) {
            $file = $request['file'];
            $image_id = $this->blog->uploadFile($file, $user_id);
            if($image_id) {
                $url = url('showImage/'.$image_id);

                return $url;
            } else {
                return false;
            };
        } else {
            return false;
        }
    }

    public function getPostForm()
    {
        return view('postForm');
    }

    public function showImage($id)
    {
        $file = $this->blog->getImageById($id);
        
        $response = Response::make($file['Content'], 200);
        $response->header("Content-Type", $file['Type']);

        return $response;
    }
}

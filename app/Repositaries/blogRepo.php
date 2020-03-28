<?php

namespace App\Repositaries;
use App\Models\articles;
use App\Exceptions\Handler as Exception;

class blogRepo
{
    public function getAllPost()
    {
        return articles::with('users')->get();
    }

    public function getPostById($id)
    {
        return articles::where('id', $id)->first();
    }

    public function insertPost($author, $title, $subtitle, $content, $date)
    {   
        try{
            $newPost = new articles();
            $newPost->author = $author;
            $newPost->title = $title;
            $newPost->subtitle = $subtitle;
            $newPost->content = $content;
            $newPost->date = $date;
            $newPost->save();

            return true;

        } catch (\Exception $e) {  
            report($e);  

            return false;
        }  
    }

    public function updatePost($id, $title, $subtitle, $content)
    {
        try{
            $post = articles::find($id);
            $post->title = $title;
            $post->subtitle = $subtitle;
            $post->content = $content;
            $post->save();

            return true;
        } catch(\Exception $e) {
            report($e);

            return false;
        }
    }
}

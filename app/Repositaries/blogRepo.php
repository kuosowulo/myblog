<?php

namespace App\Repositaries;
use App\Models\articles;
use App\Models\image;
use App\Exceptions\Handler as Exception;

class blogRepo
{
    public function getAllPost()
    {
        return articles::with('users')->where('status', 1)->get();
    }

    public function getPostById($id)
    {
        return articles::where('id', $id)->first();
    }

    public function insertPost($author, $title, $subtitle, $content, $date, $status)
    {   
        try{
            $newPost = new articles();
            $newPost->author = $author;
            $newPost->title = $title;
            $newPost->subtitle = $subtitle;
            $newPost->content = $content;
            $newPost->date = $date;
            $newPost->status = $status;
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

    public function deletePost($id)
    {
        try {
            $post = articles::find($id);
            $post->status = 0;
            $post->save();

            return true;
        } catch(\Exception $e) {
            report($e);

            return false;
        }
    }

    public function insertImage($user_id, $path)
    {
        try {
            $image_model = new Image();
            $image_model->user_id = $user_id;
            $image_model->path = $path;
            $image_model->save();

            return $image_model->id;
        } catch (\Exception $e) {
            report($e);

            return false;
        }
    }

    public function getImagePathById($id)
    {
        try {
            return Image::find($id)->path;
        } catch (\Exception $e) {
            report($e);

            return false;
        }
    }
}

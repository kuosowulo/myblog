<?php

namespace App\Services;
use App\Repositaries\blogRepo;
use Carbon\Carbon;

class blogServices
{
    public function __construct(blogRepo $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }

    public function getAllPost()
    {
        $allPosts = $this->blogRepo->getAllPost();

        foreach($allPosts as $key => $post_object) {
            $allPosts[$key]->date = $this->transformDate($post_object->date);
        }

        return $allPosts;
    }

    public function getPostById($id)
    {
        return $this->blogRepo->getPostById($id);
    }

    public function newPost($author, $title, $subtitle, $content)
    {
        $date = Carbon::today()->toDateString();

        return $this->blogRepo->insertPost($author, $title, $subtitle, $content, $date);
    }

    public function transformDate($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('F d\\, Y');
    }
}

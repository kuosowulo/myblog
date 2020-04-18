<?php

namespace App\Services;
use App\Repositaries\blogRepo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
        $post = $this->blogRepo->getPostById($id);
        $post->date = $this->transformDate($post->date);
        $relatedPost = $this->getRelatedPost($post->subtitle);

        return [$post, $relatedPost];
    }

    public function newPost($author, $title, $subtitle, $content)
    {
        $date = Carbon::today()->toDateString();
        $status = 1;

        return $this->blogRepo->insertPost($author, $title, $subtitle, $content, $date, $status);
    }

    private function transformDate($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('F d\\, Y');
    }

    public function editPost($id, $title, $subtitle, $content)
    {
        return $this->blogRepo->updatePost($id, $title, $subtitle, $content);
    }

    public function deletePost($id)
    {
        return $this->blogRepo->deletePost($id);
    }

    public function uploadFile($file, $user_id) 
    {
        $fileName = Carbon::now()->timestamp;
        $path = 'public/image/'.$fileName.'.'.$file->getClientOriginalExtension();

        try {
            Storage::disk('local')->put($path, file_get_contents($file->getRealPath()));
        } catch(\Exception $e) {
            return false;
        }

        if(Storage::disk('local')->exists($path)) {
            $image_id = $this->blogRepo->insertImage($user_id, $path);
            if($image_id) {
                return $image_id;
            }
        }

        return false; 
    }

    public function getImageById($id)
    {
        $path = $this->blogRepo->getImagePathById($id);
        
        if($path) {
            try {
                $image = Storage::disk('local')->get($path);
                $type = Storage::disk('local')->mimeType($path);
                
                return [
                    'Content' => $image,
                    'Type' => $type
                ];
            } catch(\Exception $e) {
                report($e);

                return false;
            }
        } else {
            return false;
        }
    }

    public function getRelatedPost($subtitle)
    {
        $relatedPost = $this->blogRepo->getRelatedPost($subtitle)->each(function($item) {
            return $item->url = $this->transformUrl($item->id);
        });

        return $relatedPost;
    }

    public function transformUrl($id)
    {
        return url('viewPost?id=' . $id);
    }
}

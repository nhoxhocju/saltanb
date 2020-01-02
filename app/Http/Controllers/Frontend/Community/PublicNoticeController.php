<?php

namespace App\Http\Controllers\Frontend\Community;

use Illuminate\Http\Request;
use App\Language;
use App\User;
use App\Http\Controllers\Controller;

class PublicNoticeController extends Controller
{

    public function __invoke()
    {
        
        $language = Language::where('code', '=', $_COOKIE['locale'])->get();
        // dd($language[0]);
        $posts = $language[0]->posts()->get();
        $this->filterPostActive($posts);
        // dd(gettype($posts));
        $this->setNameAuthor($posts);
        // dd($posts);
        return view($this->getView(), compact('posts', $posts));
    }

    private function getView() {
        return 'frontend.pages.public_notice';
    }

    private function filterPostActive($posts) {
        $i = 0;
        foreach ($posts as $post) {
            // dd($key);
            if($post->deleted_at != null || $post->status != 1) {
                unset($posts[$i]);
            }
            $i++;
        }
        // dd($posts);
    }

    private function getNameAuthor($id) {
        $user = User::find($id);
        return $user->name;
    }

    private function setNameAuthor($posts) {
        foreach ($posts as $post) {
            $post->author_name = $this->getNameAuthor($post->author_id);
        }

    }
}

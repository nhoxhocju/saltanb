<?php

namespace App\Http\Controllers\Frontend\Community;

use Illuminate\Http\Request;
use App\Language;
use App\User;
use App\Post;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{

    public function __invoke($id)
    {
        
        $language = Language::where('code', '=', $_COOKIE['locale'])->get();
        // dd($language[0]);
        $post = $language[0]->posts()->where('post_id', '=', $id)->get();

        // dd($post[0]->deleted_at);
        $check = $this->checkPostActive($post);
        if(!$check) {
            return redirect()->route($this->getRoute());
        }
        // dd(gettype($posts));
        $this->setNameAuthor($post);
        // dd($posts);
        return view($this->getView(), compact('post', $post));
    }

    private function getView() {
        return 'pages.detail_post';
    }

    private function getRoute() {
        return 'frontend.pages.home';
    }

    private function checkPostActive($post) {
        if($post[0]->deleted_at != null || $post[0]->status != 1) {
            return false;
        }
        return true;
    }

    private function getNameAuthor($id) {
        $user = User::find($id);
        return $user->name;
    }

    private function setNameAuthor($post) {
        foreach ($post as $post) {
            $post->author_name = $this->getNameAuthor($post->author_id);
        }

    }
}

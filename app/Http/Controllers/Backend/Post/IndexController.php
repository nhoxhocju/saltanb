<?php

namespace App\Http\Controllers\Backend\Post;

use App;
use App\Post;
use App\Language;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke() {

        $language = Language::getLanguageUses();
        $posts = $this->getAllPostActive($language);
        // dd($language);
        // dd($posts);
        $listStatus = $this->getListStatusPost();
        $postsByLanguage = $this->getDataPostsByLanguage($posts, $listStatus);
        // dd($postsByLanguage);
        $data = compact('posts', 'postsByLanguage');
        return view($this->getView(), $data);
    }

    //get View
    private function getView() {
        return 'backend.posts.index';
    }

    //get List Status
    private function getListStatusPost() {
        return config('status.post');
    }

    //get all post
    private function getAllPostActive($language) {
        return $posts = $language[0]->posts()->where('deleted_at', '=', null)->get();
    }

    //get name category by id category
    private function getNameCategoryOfPost($category_id) {
        $category = Category::find($category_id);
        return $category->name;
    }

    //get database table post_language
    private function getDataPostsByLanguage($posts, $listStatus) {

        foreach ($posts as $post) {
            $post->category_name = $this->getNameCategoryOfPost($post->category_id);
            foreach ($listStatus as $status) {
                if($post->status == $status['id']) {
                    $post->status = $status['name'];
                }
            }
        }
        return $posts;
    }
}

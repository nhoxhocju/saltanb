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

        $posts = $this->getAllPost();
        $language = Language::getLanguageUses();
        // dd($language);
        $listStatus = $this->getListStatusPost();
        $postsByLanguage = $this->getDataPostsByLanguage($posts, $language, $listStatus);
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
    private function getAllPost() {
        return Post::all();
    }

    //get name category by id category
    private function getNameCategoryOfPost($category_id) {
        $category = Category::find($category_id);
        return $category->name;
    }

    //get database table post_language
    private function getDataPostsByLanguage($posts, $language, $listStatus) {

        $posts = $language[0]->posts()->get();

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

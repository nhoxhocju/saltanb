<?php

namespace App\Http\Controllers\Backend\Post;

use App\Post;
use App\Category;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function __invoke($id) {

        $categories = $this->getListCategories(); //list category
        $postLanguage = Post::find($id)->languages()->get(); //get a post by id in all languages
        $post = Post::find($id); //get post by id
        $idCategoryOfPost = $post->category_id; //get idCategory
        $idStatusOfPost = $post->status; //get status
        $listStatus = $this->getListStatusPost(); //get list status
        $data = compact('categories', 'postLanguage', 'idCategoryOfPost', 'listStatus', 'idStatusOfPost');
        return view($this->getView(), $data);
    }

    //get view
    private function getView() {
        return 'backend.posts.edit';
    }

    //get list category in database
    private function getListCategories() {
        return Category::all();
    }

    //get list status
    private function getListStatusPost() {
        return config('status.post');
    }
}

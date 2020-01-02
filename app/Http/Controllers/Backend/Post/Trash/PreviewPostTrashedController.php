<?php

namespace App\Http\Controllers\Backend\Post\Trash;

use App;
use App\Post;
use App\Language;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreviewPostTrashedController extends Controller
{
    public function __invoke($id) {

        // $post = Post::where([['deleted_at', '<>', null], ['id', '=', $id]])->count();
        // dd($post);
        // dd($this->checkPostWereTrashed($id));
        if($this->checkPostWereTrashed($id) == false) {
            return redirect()->route($this->getRoute());
        }

        $post = Post::find($id);
        $post->category_name = $this->getNameCategoryOfPost($post);
        $post->status = $this->getNameStatusOfPost($post);
        // dd($post->category_name);
        $postLanguages = $this->getDataPostTrashedAllLanguage($id);
        $data = compact('post', 'postLanguages');
        return view($this->getView(), $data);
    }

    private function getRoute() {
        return 'backend.posts.trashes.show_trash';
    }

    //get view
    private function getView() {
        return 'backend.posts.trashes.preview';
    }

    //get list category in database
    private function getListCategories() {
        return Category::all();
    }

    //get list status
    private function getNameStatusOfPost($post) {
        $listStatus = config('status.post');
        foreach ($listStatus as $status) {
            if ($post->status == $status['id']) {
                $post->status = $status['name'];
            }
        }
        return $post->status;
    }

    private function checkPostWereTrashed($id) {
        $post = Post::where([['deleted_at', '<>', null], ['id', '=', $id]])->count();
        if($post > 0) {
            return true;
        }
        return false;
    }

    private function getNameCategoryOfPost($post) {
        $category = Category::find($post->category_id);
        $post->category_name = Category::find($post->category_id);
        return $post->category_name['name'];
    }

    private function getDataPostTrashedAllLanguage($id) {
        // $languages = Language::all();
        $postLanguages = Post::find($id)->languages()->get();
        // dd($postLanguages);
        // $postLanguages = Languages::find($id)->languages()->get(); //get a post by id in all languages
        return $postLanguages;
    }
}

<?php

namespace App\Http\Controllers\Backend\Post\Trash;

use App;
use App\Post;
use App\User;
use App\Language;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowTrashController extends Controller
{
    public function __invoke()
    {
        $language = Language::getLanguageUses();
        $posts = $this->getPostsTrashed($language);
        // dd($user);
        // dd($posts); 
        $listStatus = $this->getListStatusPost();
        $postsTrashedOfLanguage = $this->getDataPostsByLanguage($posts, $listStatus);
        $getUsers = $this->getListUsers();
        // dd($getUsers);
        $data = compact('posts', 'postsTrashedOfLanguage');
        return view($this->getView(), $data);
    }

//     //get View
    private function getView() {
        return 'backend.posts.trashes.show_trash';
    }

    private function getListUsers() {
        return User::all();
    }

    //get List Status
    private function getListStatusPost() {
        return config('status.post');
    }

    //get all post
    private function getPostsTrashed($language) {
        return $posts = $language[0]->posts()->where('deleted_at', '<>', 'null')->get();
    }

    private function getNameDeletedBy($id) {
        $name = User::find($id)->select('name')->get();
        return $name[0]->name;
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
            $post->deleted_by = $this->getNameDeletedBy($post->deleted_by);
            foreach ($listStatus as $status) {
                if($post->status == $status['id']) {
                    $post->status = $status['name'];
                }
            }
        }
        return $posts;
    }
}

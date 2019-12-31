<?php

namespace App\Http\Controllers\Backend\Post;

use Auth;
use App\Post;
use App\Language;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\EditRequest;
// use Illuminate\Validation\Factory as Validator;


class UpdateController extends Controller
{

    public function __invoke(EditRequest $request, Post $post, $id) {

        $now = new \DateTime();
        $request->merge(['author_id' => Auth::id(), 'updated_at' => $now]);
        $post = $this->findPostById($id);
        $postFillable = $this->getPostFillable();
        $data = $this->getFilterData($request, $postFillable);
        $result = $this->savePost($post, $data);
        $message = $this->getMessage($result);
        return redirect()->route($this->getRoute(), $id)->with($message);
    }

    //find post by id
    private function findPostById($id) {
        return Post::find($id);
    }

    //get route
    private function getRoute() {
        return "backend.posts.edit";
    }

    //get fillable of post
    private function getPostFillable() {
        return config('fillable.post');
    }

    //filter data use $postFillable
    private function getFilterData($request, $postFillable) {
        return array_filter($request->only($postFillable));
    }

    //Save post
    private function savePost($post, $data) {
        return $post->fill($data)->save();
    }
    
    //message result
    private function getMessage($result) {
        if ($result) {
            return ['message' => __('Update a post completed!'), 'type' => 'success'];
        }
        return ['message' => __('An error occurred! Please try again!'), 'type' => 'error'];
    }
}

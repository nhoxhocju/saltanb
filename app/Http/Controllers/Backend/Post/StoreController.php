<?php

namespace App\Http\Controllers\Backend\Post;

use Auth;
use App\Post;
use App\Language;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreateRequest;

class StoreController extends Controller
{
    public function __invoke(CreateRequest $request, Post $post) {
        
        $request->merge(['author_id' => Auth::id()]);
        
        $postFillable = $this->getPostFillable();
        $data = $this->getFilterData($request, $postFillable);
        $result = $this->savePost($post, $data);
        // dd($result);
        // exit;
        $message = $this->getMessage($result);
        return redirect()->route($this->getRoute())->with($message);
    }

    //get route
    private function getRoute()
    {
        return 'backend.posts.index';
    }

    //get fillable of post
    private function getPostFillable() {
        return config('fillable.post');
    }

    //filter data use $postFillable
    private function getFilterData($request, $postFillable)
    {
        return array_filter($request->only($postFillable));
    }

    //save Post
    private function savePost($post, $data)
    {
        return $post->fill($data)->save();
    }

    //Message
    private function getMessage($result)
    {
        if ($result) {
            return ['message' => __('Create a post completed!'), 'type' => 'success'];
        }
        return ['message' => __('An error occurred! Please try again!'), 'type' => 'error'];
    }
}

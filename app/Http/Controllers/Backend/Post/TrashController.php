<?php

namespace App\Http\Controllers\Backend\Post;

use Auth;
use App\Post;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function __invoke(Request $request, $id) {

        $post = Post::find($id);
        // printf($post);exit;
        $now = new \DateTime();
        $request->merge(['deleted_by' => Auth::id(), 'deleted_at' => $now]);
        // dd($request->all());
        $postFillable = $this->getPostFillable();
        $data = $this->getFilterData($request, $postFillable);
        // dd($data);
        $result = $this->moveToTrash($post, $data);
        // dd($result);
        $message = $this->getMessage($result);
        return redirect()->route($this->getRoute())->with($message);

    }

    //get view
    private function getRoute() {
        return 'backend.posts.index';
    }

    private function getPostFillable() {
        return config('fillable.post');
    }

    private function getFilterData($request, $postFillable) {
        array_push($postFillable, '_method', '_token');
        return array_filter($request->except($postFillable));
    }

    private function getMessage($result)
    {
        if ($result) {
            return ['message' => __('Move to trash post completed!'), 'type' => 'success'];
        }
        return ['message' => __('An error occurred! Please try again!'), 'type' => 'error'];
    }

    private function moveToTrash($post, $data) {
        return $post->fill($data)->save();
    }
}

<?php

namespace App\Http\Controllers\Backend\Post;

use Auth;
use App\Post;
use App\Language;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(Request $request, $id) {
        
        $result = $this->checkPostWereTrashed($id);
        if($result == false) {
            $message = $this->getMessage($result);
            return redirect()->route($this->getRoute())->with($message);
        }
        $post = Post::find($id);
        // dd($request->all());
        $result = $post->delete();
        $message = $this->getMessage($result);
        return redirect()->route($this->getRoute())->with($message);
    }

    // //get route
    private function getRoute()
    {
        return 'backend.posts.trashes.show_trash';
    }

    private function checkPostWereTrashed($id) {
        $post = Post::where([['deleted_at', '<>', null], ['id', '=', $id]])->count();
        if($post > 0) {
            return true;
        }
        return false;
    }

    // //Message
    private function getMessage($result)
    {
        if ($result) {
            return ['message' => __('Create a post completed!'), 'type' => 'success'];
        }
        return ['message' => __('An error occurred! Please try again!'), 'type' => 'error'];
    }
}

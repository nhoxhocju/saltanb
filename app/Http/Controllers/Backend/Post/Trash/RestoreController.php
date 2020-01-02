<?php

namespace App\Http\Controllers\Backend\Post\Trash;

use Auth;
use App\Post;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestoreController extends Controller
{
    public function __invoke(Request $request, $id) {

        if($this->checkPostWereTrashed($id) == false) {
            $message = $this->getMessage(false);
            return redirect()->route($this->getRoute())->with($message);
        }
        $post = Post::find($id);
        $post->deleted_at = null;
        $post->deleted_by = null;
        $result = $this->restore($post);
        // dd($result);
        $message = $this->getMessage($result);
        return redirect()->route($this->getRoute())->with($message);

    }

    private function checkPostWereTrashed($id) {
        $post = Post::where([['deleted_at', '<>', null], ['id', '=', $id]])->count();
        if($post > 0) {
            return true;
        }
        return false;
    }

    //get view
    private function getRoute() {
        return 'backend.posts.trashes.show_trash';
    }

    private function getMessage($result)
    {
        if ($result) {
            return ['message' => __('Restore post completed!'), 'type' => 'success'];
        }
        return ['message' => __('An error occurred! Please try again!'), 'type' => 'error'];
    }

    private function restore($post) {
        return $post->save();
    }
}

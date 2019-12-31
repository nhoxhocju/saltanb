<?php

namespace App\Http\Controllers\Backend\Post;

use App\Category;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke() {

        $categories = Category::all();
        return view($this->getView(), compact('categories', $categories));
    }

    private function getView() {
        return 'backend.posts.create';
    }

}

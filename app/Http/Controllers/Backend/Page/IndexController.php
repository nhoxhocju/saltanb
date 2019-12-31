<?php

namespace App\Http\Controllers\Backend\Page;

use App\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke() {

        $pages = Page::all();
        $statusPage = $this->getStatusPage();
        $this->convertStatusPage($pages, $statusPage);
        $data = compact('pages');
        return view($this->getView(), $data);
    }

    private function getView() {
        return 'backend.pages.index';
    }

    private function getStatusPage() {
        return config('status.page');
    }

    private function convertStatusPage($pages, $statusPage) {

        foreach ($pages as $page) {
            $page->is_static = $statusPage[$page->is_static];
        }
    }
}

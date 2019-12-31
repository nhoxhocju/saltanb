<?php

namespace App\Http\Controllers\Backend\Grapesjs;

use Illuminate\Support\Facades\Storage;
use App\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke($id) {

        $page = Page::find($id);

        $html = Storage::disk('resources_view_grapesjs')->get($page->url_page . "/" . "html.blade.php");
        $css = Storage::disk('resources_view_grapesjs')->get($page->url_page . "/" . "css.blade.php");
        // dd($css);  
        // echo strval($html);
        // exit; 
        // $meo2 = json_encode($css);
        // dd($meo2);
        return view('backend.grapesjs.edit', compact('page', $page));
    }
}

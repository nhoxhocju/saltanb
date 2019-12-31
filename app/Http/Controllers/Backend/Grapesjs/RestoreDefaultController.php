<?php

namespace App\Http\Controllers\Backend\Grapesjs;

use Illuminate\Support\Facades\Storage;
use App\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestoreDefaultController extends Controller
{
    public function __invoke($id, Request $request) {

        if ($request->ajax()) {

            $linkCss = "href={{ asset('css/grapesjs.css') }}";

            $page = Page::find($id);

            $html = $this->getHtmlFromFile($page);
            $css = $this->getCssFromFile($page);

            $code = "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <meta http-equiv='X-UA-Compatible' content='ie=edge'>
                <title>Document</title>
                <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
                <link rel='stylesheet' $linkCss>
                <style>
                    $css
                </style>
                
            </head>
            <body>
                $html
                <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
                <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
            </html>";

            $this->writeFile($page, $html, $css, $code);

            echo json_encode('success');
        }
    }

    private function getHtmlFromFile($page) {

        return Storage::disk('public')->get('default_themeplate/'. $page->url_page . '/html.blade.php');
    }

    private function getCssFromFile($page) {

        return Storage::disk('public')->get('default_themeplate/'. $page->url_page . '/css.blade.php');
    }

    private function writeFile($page, $html, $css, $code) {

        Storage::disk('resources_view_grapesjs')->put($page->url_page . "/" . "html.blade.php", $html);
        Storage::disk('resources_view_grapesjs')->put($page->url_page . "/" . "css.blade.php", $css);

        Storage::disk('resources_view_frontend')->put($page->url_page . ".blade.php", $code);
    }
}

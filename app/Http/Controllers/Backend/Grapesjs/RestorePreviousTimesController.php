<?php

namespace App\Http\Controllers\Backend\Grapesjs;

use Illuminate\Support\Facades\Storage;
use App\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestorePreviousTimesController extends Controller
{
    public function __invoke($id, Request $request) {

        if ($request->ajax()) {

            $linkCss = "href={{ asset('css/grapesjs.css') }}";

            $page = Page::find($id);

            $oldHtml = $this->getOldHtmlFromFile($page);
            $oldCss = $this->getOldCssFromFile($page);

            $currentHtml = $this->getCurrentHtmlFromFile($page);
            $currentCss = $this->getCurrentCssFromFile($page);

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
                    $oldCss
                </style>
                
            </head>
            <body>
                $oldHtml
                <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
                <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
            </html>";

            $this->writeFile($page, $oldHtml, $oldCss, $code);
            $this->backupFile($page, $currentHtml, $currentCss);

            echo json_encode('success');
        }
    }

    private function getOldHtmlFromFile($page) {

        return Storage::disk('public')->get('backup_previous_times/'. $page->url_page . '/html.blade.php');
    }

    private function getOldCssFromFile($page) {

        return Storage::disk('public')->get('backup_previous_times/'. $page->url_page . '/css.blade.php');
    }

    private function getCurrentHtmlFromFile($page) {
        return Storage::disk('resources_view_grapesjs')->get($page->url_page . "/" . "html.blade.php");
    }

    private function getCurrentCssFromFile($page) {
        return Storage::disk('resources_view_grapesjs')->get($page->url_page . "/" . "css.blade.php");
    }

    private function writeFile($page, $oldHtml, $oldCss, $code) {

        Storage::disk('resources_view_grapesjs')->put($page->url_page . "/" . "html.blade.php", $oldHtml);
        Storage::disk('resources_view_grapesjs')->put($page->url_page . "/" . "css.blade.php", $oldCss);

        Storage::disk('resources_view_frontend')->put($page->url_page . ".blade.php", $code);
    }

    private function backupFile($page, $currentHtml, $currentCss) {
        Storage::disk('public')->put('backup_previous_times/'. $page->url_page . '/html.blade.php', $currentHtml);
        Storage::disk('public')->put('backup_previous_times/'. $page->url_page . '/css.blade.php', $currentCss);
    }
}

<?php

namespace App\Http\Controllers;

use App;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LocalizationController extends Controller
{
    public function __invoke($locale) {

        $lang = Language::where('code', '=', $locale)->get();
        // dd($lang);
        // dd(App::getLocale());
        if($lang->isEmpty()) {
            $locale = App::getLocale();
        }
        setcookie("locale", $locale, time()+3600, "/");
        return redirect()->back();
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!isset($_COOKIE['locale'])) {
            $locale = App::getLocale();
            // dd($locale);
            App::setLocale($locale);
            setcookie("locale", $locale, time()+3600, "/"); 
        }else{
            App::setLocale($_COOKIE['locale']);
        }
        return $next($request);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'code',
        'language',
        'created_at',
        'updated_at',
    ];

    public function posts() {
        
        return $this->belongsToMany('App\Post', 'post_language', 'language_id', 'post_id')->withPivot([
            'post_id',
            'language_id',
            'title',
            'content'
        ]);
    }

    public static function getLanguageUses() {
        return $language = Language::where('code', '=', $_COOKIE['locale'])->get();
    }
}

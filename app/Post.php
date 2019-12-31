<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'category_id',
        'author_id',
        'status',
        'created_at',
        'post_id',
        'language_id',
        'title',
        'content',
        'updated_at',
        'deleted_at',
        'deleted_by',
    ];

    public function category() {

        return $this->beLongsTo('App\Category');
    }

    public function languages() {
        
        return $this->belongsToMany('App\Language', 'post_language', 'post_id', 'language_id')->withPivot([
            'post_id',
            'language_id',
            'title',
            'content'
        ]);
    }
}

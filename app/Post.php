<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    protected $fillable = [
        'title', 'body', 'author_id', 'category_id', 'tag_id'
    ];

    protected $table = 'posts';

    public function comments()
    {
        return $this->hasMany('App\Comment','on_post');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tags_relationship');
    }
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }


}


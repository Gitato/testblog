<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    protected $table='comments';

    public function posts()
    {
        return $this->belongsTo('App\Post', 'on_post');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'from_user');
    }
    public function answer()
    {
        return $this->hasMany('App\Comment', 'on_comment');
    }
    public function ChildAnswer()
    {
        return $this->hasMany('App\Comment', 'on_comment')->with('answer');
    }
}

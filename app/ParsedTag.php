<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParsedTag extends Model
{
    protected $fillable = ['parsed_tag'];

    public function parsedPosts()
    {
        return $this->belongsToMany('App\Parser', 'parsed_tags_relationship');
    }
}

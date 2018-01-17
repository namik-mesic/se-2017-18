<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upvote extends Model
{
    protected $fillable = [
        'id', 'user_id', 'post_id', 'comment_id'
    ];

    function user(){
        return $this->belongsTo('App\User');
    }

    function post(){
        return $this->belongsTo('App\Post');
    }
}

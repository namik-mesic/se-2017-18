<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'id', 'user_id', 'post_id' ,'text'
    ];

    function user(){
        return $this->belongsTo('App\User');
    }

    function post(){
        return $this->belongsTo('App\Post');
    }

    function likes(){
        return $this->hasMany('App\Like');
    }
}

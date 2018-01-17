<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'id', 'user_id', 'text'
    ];

    function user(){
        return $this->belongsTo('App\User');
    }

    function upvotes(){
        return $this->hasMany('App\Upvote');
    }
}
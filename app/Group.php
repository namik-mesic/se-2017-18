<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'id', 'name', 'image_url', 'description'
    ];

    function groupusers(){
        return $this->hasMany('App\GroupUser');
    }

    function posts(){
        return $this->hasMany('App\Post');
    }

    function files(){
        return $this->hasMany('App\File');
    }
}

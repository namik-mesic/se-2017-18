<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password', 'image_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function index(){
        return null;
    }

    function posts(){
        return $this->hasMany('App\Post');
    }

    function comments(){
        return $this->hasMany('App\Comment');
    }

    function likes(){
        return $this->hasMany('App\Like');
    }

    function groupusers(){
        return $this->hasMany('App\GroupUser');
    }

    function files(){
        return $this->hasMany('App\File');
    }

}

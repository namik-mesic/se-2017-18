<?php

namespace App;

use Auth;
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
        'id', 'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function posts(){
        return $this->hasMany('App\Post');
    }

    function likes(){
        return $this->hasMany('App\Upvote');
    }


    function friends(){
        return $this->hasMany('App\Friend');
    }

    function hasUpvote($post_id){
        return Upvote::where('user_id', '=', Auth::user()->id)
                    ->where('post_id', '=', $post_id)
                    ->count() > 0;
    }

    function isFriend($friend_id){
        return Friend::where('user_id', '=', Auth::user()->id)
                    ->where('friend_id', '=', $friend_id)
                    ->where('status', '=', 'yes')
                    ->count() > 0;
    }

    function requestSent($friend_id){
        return Friend::where('user_id', '=', Auth::user()->id)
                ->where('friend_id', '=', $friend_id)
                ->where('status', '=', 'no')
                ->count() > 0;
    }
}

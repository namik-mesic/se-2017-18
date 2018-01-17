<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = [
        'id', 'user_id', 'friend_id', 'status'
    ];

    function user(){
        return $this->belongsTo('App\User');
    }
}

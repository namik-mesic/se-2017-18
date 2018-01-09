<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $fillable = [
        'id', 'user_id', 'group_id', 'privilege'
    ];

    function user(){
        return $this->belongsTo('App\User');
    }

    function group(){
        return $this->belongsTo('App\Group');
    }
}

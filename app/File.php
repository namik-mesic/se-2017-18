<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'id', 'user_id', 'group_id', 'file_url'
    ];

    function user(){
        return $this->belongsTo('App\User');
    }

    function group(){
        return $this->belongsTo('App\Group');
    }
}

<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    protected $fillable = [
        'name', 'description', 'place', 'date', 'hour','user_id'
    ];
}
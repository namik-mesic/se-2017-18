<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Advert extends model
{
    /**
     * @var
     */
    protected $fillable = [
        'titles',
        'texts',
        'picture',
        'activefrom',
        'activeto',
    ];
}
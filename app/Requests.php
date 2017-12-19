<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Requests extends model
{
    /**
     * @var
     */
    protected $fillable = [
        'statusat',
    ];
}
<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Requests extends Model
{
    /**
     * @var
     */
    protected $fillable = [
        'statusat',
    ];
}
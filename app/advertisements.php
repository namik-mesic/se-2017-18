<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class advertisements extends Model
{
    /**
     * @var
     */
    protected $fillable = ['titles','image','description'];

}
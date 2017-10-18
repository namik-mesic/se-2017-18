<?php
/**
 * Created by PhpStorm.
 * User: Magnus
 * Date: 11-Oct-17
 * Time: 23:58
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Offer extends model
{

    /**
     * @var
     */
    protected $fillable = [
        'meal',
        'ingredients',
        'cost',
    ];

}
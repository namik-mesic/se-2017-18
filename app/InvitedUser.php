<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6.1.2018
 * Time: 11:53
 */

namespace App;


class InvitedUser extends User
{
    protected $fillable = [
        'invited', 'response'
    ];
}
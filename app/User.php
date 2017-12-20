<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int id
 * @property string name
 * @property string email
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * Relation to get all conversations of user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function conversations(){
        return $this->belongsToMany('App\Conversation', 'chat_participant');
    }

    /**
     * Relation to get all messages of user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function messages(){
        return $this->hasMany('App\Message');
    }
}

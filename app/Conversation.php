<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'featured',
        'notifications',
        'ignored',
        'blocked',
    ];

    /**
     * Relation to get all users from conversation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function users(){
        return $this->belongsToMany('App\User', 'chat_participant');
    }

    /**
     * Relation to get all messages from conversation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function messages(){
        return $this->hasMany('App\Message');
    }

    /**
     * Scope to get all unread messages from conversation.
     *
     * @param $query
     * @return mixed
     */
    public function scopeUnread($query)
    {
        return $query->where('unread', '==', false);
    }


}

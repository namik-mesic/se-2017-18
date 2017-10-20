<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'deleted',
        'hidden',
    ];

    /**
     * Get the conversation that owns the message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conversation(){
        return $this->belongsTo('App\Conversation');
    }

    /**
     * Get the user that owns the message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User');
    }


}

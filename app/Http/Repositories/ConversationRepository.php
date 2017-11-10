<?php

namespace App\Http\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;

class ConversationRepository implements ConversationRepositoryInterface {
    /**
     * Get all conversations of auth user that not contain object of auth user.
     *
     * @return mixed
     */
    public function getConversationsWithoutAuthUser(){
        return User::find(Auth::user()->id)->conversations()->whereHas('messages')->with(
            [
                'users' => function ($query) {
                    $query->where('users.id', '!=', Auth::user()->id);
                },
                'messages' => function ($query) {
                    $query->where('messages.read', '==', false);
                }
            ]
        )->get();
    }
}
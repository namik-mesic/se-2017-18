<?php

namespace App\Http\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;

class ConversationRepository implements ConversationRepositoryInterface {
    /**
     * Get all conversations of user that not contain object of auth user.
     *
     * @param User $user
     * @return User
     */
    public function getUsersConversations(User $user){
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
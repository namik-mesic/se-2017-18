<?php

namespace App\Repositories\MySQL;


use App\Repositories\ConversationRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Class ConversationRepository
 * @package App\Repositories
 */
class ConversationRepository implements ConversationRepositoryInterface {
    /**
     * Get all conversations of user that not contain object of auth user.
     *
     * @param User $user
     * @return Collection
     */
    public function getUsersConversations(User $user){
        return User::find($user->id)->conversations()->whereHas('messages')->with(
            [
                'users' => function ($query) use ($user) {
                    $query->where('users.id', '!=', $user->id);
                },
                'messages' => function ($query) {
                    $query->where('messages.read', '==', false)->where('messages.deleted', '==', false)->orderBy('created_at', 'desc')->get();
                }
            ]
        )->get();
    }
}
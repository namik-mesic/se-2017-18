<?php

namespace App\Http\Repositories;

use App\User;

interface ConversationRepositoryInterface {
    /**
     * Get all conversations of user that not contain object of auth user.
     *
     * @param User $user
     * @return User
     */
    public function getUsersConversations(User $user);
}
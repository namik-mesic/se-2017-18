<?php

namespace App\Repositories;

use App\User;

/**
 * Class ConversationRepository
 * @package App\Repositories
 */
interface ConversationRepositoryInterface {
    /**
     * Get all conversations of user that not contain object of auth user.
     *
     * @param User $user
     * @return User
     */
    public function getUsersConversations(User $user);
}
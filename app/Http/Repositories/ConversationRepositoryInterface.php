<?php

namespace App\Repositories;

use App\User;
use Illuminate\Http\Request;

/**
 * Class ConversationRepository
 * @package App\Repositories
 */
interface ConversationRepositoryInterface {
    /**
     * Get all conversations of user that not contain object of auth user.
     *
     * @param Request $request
     * @param User $user
     * @return User
     */
    public function getUsersConversations(Request $request, User $user);

}
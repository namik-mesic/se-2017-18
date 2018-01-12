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

    /**
     *
     * Get conversation with user
     *
     * @param Request $request
     * @param User $user
     * @return mixed
     */
    public function getConversationWithUser(Request $request, User $user);

    /**
     * @param Request $request
     * @return mixed
     */
    public function createConversation(Request $request);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteConversation($id);
}
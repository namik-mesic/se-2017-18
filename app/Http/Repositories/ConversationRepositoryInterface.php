<?php

namespace App\Http\Repositories;

interface ConversationRepositoryInterface {
    /**
     * Get all conversations of auth user that not contain object of auth user.
     *
     * @return mixed
     */
    public function getConversationsWithoutAuthUser();
}
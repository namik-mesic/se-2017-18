<?php

namespace App\Repositories;

use App\Message;
use App\User;
use Illuminate\Http\Request;

/**
 * Class ConversationRepository
 * @package App\Repositories
 */
interface MessageRepositoryInteface {
    /**
     * Get all messages of the conversation.
     *
     * @param Request $request
     * @param User $user
     * @return Message[]|static
     */
    public function getMessagesOfConversation(Request $request, User $user);

}
<?php

namespace App\Repositories;

use App\Message;
use App\User;
use Illuminate\Http\Request;

/**
 * Class ConversationRepository
 * @package App\Repositories
 */
interface MessageRepositoryInterface {
    /**
     * Get all messages of the conversation.
     *
     * @param Request $request
     * @return Message[]|static
     */
    public function getMessagesOfConversation(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function updateMessagesToRead(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function createMessage(Request $request);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteMessage($id);
}
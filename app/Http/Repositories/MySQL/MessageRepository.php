<?php

namespace App\Repositories\MySQL;

use App\Message;
use App\Repositories\MessageRepositoryInteface;
use App\User;
use Illuminate\Http\Request;

/**
 * Class MessageRepository
 * @package App\Repositories
 */
class MessageRepository implements MessageRepositoryInteface
{

    /**
     * Get all messages of the conversation.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMessagesOfConversation(Request $request, User $user)
    {
        return Message::where('conversation_id', '=', $request->id)->get();
    }
}
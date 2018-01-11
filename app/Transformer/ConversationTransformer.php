<?php

namespace App\Transformer;
use App\Conversation;
use App\Message;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 * @package App\Transformer
 */
class ConversationTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'users',
        'messages'
    ];
    /**
     * @param Conversation $conversation
     * @return array
     */
    public function transform(Conversation $conversation)
    {
        return [
            'id' => $conversation->id,
            'name' => $conversation->name,
            'featured' => $conversation->featured,
            'notifications' => $conversation->notifications,
            'ignored' => $conversation->ignored,
            'blocked' => $conversation->blocked,
            'created_at' => $conversation->created_at,
            'hasUnreadMessages' => $this->hasUnreadMessages($conversation)
        ];
    }

    public function includeUsers(Conversation $conversation) {
        $users = $conversation->users;

        return $this->collection($users, new UserTransformer);
    }

    public function includeMessages(Conversation $conversation) {
        $messages = $conversation->messages;

        return $this->collection($messages, new MessageTransformer);
    }

    public function hasUnreadMessages(Conversation $conversation) {
        $hasUnreadMessages = Message::where('conversation_id', '=', $conversation->id)->unread()->first();

        if ($hasUnreadMessages === null) {
            return false;
        }

        return true;
    }

}
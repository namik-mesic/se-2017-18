<?php

namespace App\Transformer;
use App\Conversation;
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
            'created_at' => $conversation->created_at
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

}
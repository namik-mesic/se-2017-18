<?php

namespace App\Transformer;
use App\Message;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

/**
 * Class MessageTransformer
 * @package App\Transformer
 */
class MessageTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'user'
    ];
    /**
     * @param Message $message
     * @return array
     */
    public function transform(Message $message)
    {
        return [
            'id' => $message->id,
            'text' => $message->text,
            'read' => $message->read,
            'deleted' => $message->deleted,
            'hidden' => $message->hidden,
            'date' => Carbon::createFromTimestamp(strtotime($message->created_at))->diffForHumans(),
            'time' => $message->created_at->format('h:i A'),
            'created_at' => $message->created_at,
            'updated_at' => $message->updated_at,
        ];
    }

    public function includeUser(Message $message) {
        $user = $message->user;

        return $this->item($user, new UserTransformer);
    }
}
<?php

namespace App\Repositories\MySQL;

use App\Message;
use App\Repositories\MessageRepositoryInterface;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class MessageRepository
 * @package App\Repositories
 */
class MessageRepository implements MessageRepositoryInterface
{

    /**
     * @var ConversationRepository
     */
    private $conversationRepository;

    /**
     * MessageRepository constructor.
     */
    public function __construct()
    {
        $this->conversationRepository = app(ConversationRepository::class);
    }

    /**
     * Get all messages of the conversation.
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMessagesOfConversation(Request $request)
    {
        $this->updateMessagesToRead($request);

        return Message::where('conversation_id', '=', $request->id)->get();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function updateMessagesToRead(Request $request)
    {
        Message::where('conversation_id', '=', $request->id)
            ->where('read', '=', false)
            ->update([
               'read' => true
            ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createMessage(Request $request)
    {
        $conversationId = $request->conversation_id;

        if($request->to_user !== null) {
            $conversation = $this->conversationRepository
                ->createConversation($request);

            $conversationId = $conversation->id;
        }

        $message = new Message;

        $message->text = $request->message;
        $message->conversation_id = $conversationId;
        $message->user_id = $request->user_id;
        $message->read = true;

        if($message->save()) {
            $messageCollection = new Collection(collect([$message]));
            return $messageCollection;
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteMessage($id)
    {
        $message = Message::find($id);

        if($message->delete()) {
            $hasMessages = $message->conversation()->has('messages')->count();
            if ($hasMessages === 0) {
                $conversationId = $message->conversation->id;

                $this->conversationRepository
                    ->deleteConversation($conversationId);
            }
            return response()->json([
                'success' => true,
                'message' => 'Message deleted successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'There was a problem while deleting a message.'
        ]);
    }

    /**
     * Get only new messages of the conversation.
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getNewMessagesOfConversation(Request $request)
    {
        $this->updateMessagesToRead($request);

        return Message::where('conversation_id', '=', $request->id)
            ->where('user_id', '!=', $request->user)
            ->where('id', '>', $request->last_poll)
            ->get();
    }
}
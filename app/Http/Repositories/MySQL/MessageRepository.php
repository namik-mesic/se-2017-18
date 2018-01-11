<?php

namespace App\Repositories\MySQL;

use App\Message;
use App\Repositories\MessageRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

/**
 * Class MessageRepository
 * @package App\Repositories
 */
class MessageRepository implements MessageRepositoryInterface
{

    /**
     * Get all messages of the conversation.
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMessagesOfConversation(Request $request)
    {
        $this->updateMessagesToRead($request);

        return Message::where('conversation_id', '=', $request->id)->where('deleted', '=', false)->get();
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
        $message = new Message;

        $message->text = $request->message;
        $message->conversation_id = $request->conversation_id;
        $message->user_id = $request->user_id;
        $message->read = true;

        if($message->save()) {
            return response()->json([
                'success' => true,
                'message_id' => $message->id,
                'message' => 'Message created successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'There was a problem while sending a message.'
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteMessage($id)
    {
        $message = Message::find($id);

        $message->deleted = true;

        if($message->save()) {
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
}
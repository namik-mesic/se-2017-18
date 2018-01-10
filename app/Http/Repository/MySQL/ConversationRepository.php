<?php

namespace App\Repositories\MySQL;


use App\Conversation;
use App\Repositories\ConversationRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class ConversationRepository
 * @package App\Repositories
 */
class ConversationRepository implements ConversationRepositoryInterface {
    /**
     * Get all conversations of user that not contain object of auth user.
     *
     * @param Request $request
     * @param User $user
     * @return Collection
     */
    public function getUsersConversations(Request $request, User $user){

        /*
        return Conversation::select('conversations.*')
            ->join('chat_participant', 'chat_participant.conversation_id', '=', 'conversations.id')
            ->join('users', 'users.id', '=', 'chat_participant.user_id')
            ->where('users.id', '=', $user->id)
            ->where('users.name', 'like', '%' . $request->get('searchConversationQuery') . '%')
            ->get();

        return $user->conversations()
            ->select('conversations.*')
            ->whereHas('messages')
            ->join('users', 'users.id', '=', 'chat_participant.user_id')
            ->where('users.name', 'LIKE', '%' . $request->get('searchConversationQuery') . '%')
            ->with('messages')
            ->groupBy('conversations.id')
            ->get();
        */
        return User::find($user->id)->conversations()->whereHas('messages')->with(
            [
                'users' => function ($query) use ($user, $request) {
                    $query->where('users.id', '!=', $user->id);
                    },
                'messages' => function ($query) use ($user, $request) {
                    $query
                        ->where('messages.read', '==', false)
                        ->where('messages.deleted', '==', false)->orderBy('created_at', 'desc')->get();
                }
            ]
        )->whereHas('users', function ($query) use ($request) {
            $query->where('users.name', 'like', '%' . $request->searchQuery . '%');
        })->get();
    }

}
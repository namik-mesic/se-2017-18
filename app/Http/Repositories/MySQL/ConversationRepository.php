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
            ->join('chat_participant', 'conversations.id', '=', 'chat_participant.conversation_id')
            ->where('chat_participant.user_id', '=', $user->id)
            ->join('messages', 'messages.conversation_id', '=', 'conversations.id')
            ->groupBy('conversations.id')
            ->orderBy('messages.id', 'desc')
            ->get();
        */

         return User::find($user->id)
            ->conversations()
            ->with([
                'users' => function ($query) use ($user, $request) {
                    $query->where('users.id', '!=', $user->id);
                    },
                'messages' => function ($query) use ($user, $request) {
                    $query->latest('id')->get();
                }
            ])->whereHas(
                'users', function ($query) use ($request) {
                    $query->where('users.name', 'like', '%' . $request->searchQuery . '%');
            })->orderBy('conversations.id', 'desc')
             ->get();

    }

    /**
     *
     * Get conversation with user
     *
     * @param Request $request
     * @param User $user
     * @return mixed
     */
    public function getConversationWithUser(Request $request, User $user)
    {
        return User::find($user->id)
            ->conversations()
            ->has('users', '=', 2)
            ->whereHas('users', function ($query) use ($request) {
                $query->where('users.id', '=', $request->id);
            })
            ->with([
                'users' => function ($query) use ($user, $request) {
                    $query->where('users.id', '!=', $user->id);
                },
                'messages'
            ])
            ->get();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createConversation(Request $request)
    {
        $conversation = new Conversation;
        $conversation->save();

        $conversation->users()->attach([$request->user_id, $request->to_user]);

        return $conversation;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteConversation($id)
    {
        $conversation = Conversation::find($id);

        if($conversation->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Conversation deleted successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'There was a problem while deleting a conversation.'
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function addUsersToConversation(Request $request)
    {
        if (is_array($request->users)) {
            $conversation = Conversation::find($request->conversation_id);
            $conversation->users()->attach($request->users);

            return new Collection(collect([$conversation]));
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function deleteUsersOfConversation(Request $request)
    {

        if (is_array($request->users)) {

            $conversation = Conversation::find($request->conversation_id);
            $conversation->users()->detach($request->users);

            $hasUsers = $conversation->users()->count() - 1;

            if($hasUsers === 0) {
                $conversation->delete();
            }

            return new Collection(collect([$conversation]));
        }
    }
}
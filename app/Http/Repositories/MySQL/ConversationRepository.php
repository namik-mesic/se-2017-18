<?php

namespace App\Repositories\MySQL;


use App\Conversation;
use App\Repositories\ConversationRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return User::find($user->id)
            ->conversations()
            ->with([
                'users' => function ($query) use ($user, $request) {
                    $query->where('users.id', '!=', $user->id);
                    },
                'messages' => function ($query) use ($user, $request) {
                    $query->latest('id')->get();
                }
            ])->whereHas('users', function ($query) use ($request) {
                $query->where('users.name', 'like', '%' . $request->searchQuery . '%');
            })->get();
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
}
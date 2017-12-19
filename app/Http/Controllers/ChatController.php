<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ConversationRepository;

class ChatController extends Controller
{
    /**
     * @var ConversationRepository
     */
    protected $conversationRepositroy;

    /**
     * Chat controller constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->conversationRepositroy = app(ConversationRepository::class) ;
    }

    /**
     * Get all conversations of user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConversations()
    {
        $conversations = $this->conversationRepositroy->getUsersConversations(Auth::user());

        return view('chat.index', [
            'conversations' => $conversations
        ]);
    }
}

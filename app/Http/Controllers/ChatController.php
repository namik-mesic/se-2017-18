<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ConversationRepository;

class ChatController extends Controller
{
    private $conversationRepositroy;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->conversationRepositroy = new ConversationRepository();
    }

    /**
     * Get all conversations of user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conversations = $this->conversationRepositroy->getConversationsWithoutAuthUser();

        return view('chat.index', [
            'conversations' => $conversations
        ]);
    }
}

<?php

namespace App\Http\Controllers;


use App\Repositories\ConversationRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    /**
     * @var ConversationRepositoryInterface
     */
    protected $conversationRepositroy;

    /**
     * Chat controller constructor.
     */
    public function __construct()
    {
        $this->conversationRepositroy = app(ConversationRepositoryInterface::class) ;
    }

    /**
     * Get all conversations of user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConversations()
    {
        return $this->conversationRepositroy->getUsersConversations(Auth::user());
    }
}

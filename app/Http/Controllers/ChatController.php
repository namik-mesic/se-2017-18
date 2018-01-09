<?php

namespace App\Http\Controllers;

use App\Repositories\MySQL\ConversationRepository;
use Illuminate\Support\Facades\Auth;

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
        $this->conversationRepositroy = app(ConversationRepository::class) ;
    }

    /**
     * Chat controller constructor.
     */
    public function index(){

        return view('chat.index');
    }
}

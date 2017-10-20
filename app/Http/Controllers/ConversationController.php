<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get all conversations of user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_user = Auth::user();

        $conversations = $auth_user->conversations;

        return view('chat.partials.conversations', [$conversations]);
    }

}

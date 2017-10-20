<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
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
        $available_users = User::all()->except($auth_user->id);

        return view('chat.index', [
                'conversations' => $conversations,
                'available_users' => $available_users
            ]);
    }
}

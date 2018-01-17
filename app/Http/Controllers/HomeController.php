<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Upvote;
use Auth;
use App\Post;
use App\User;
use DB;
use function foo\func;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::query()
            ->leftJoin('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('friends', 'posts.user_id', '=','friends.friend_id')
            ->where('friends.user_id', '=', Auth::user()->id)
            ->where('friends.status', '=', 'yes')
            ->orWhere('posts.user_id', '=', Auth::user()->id)
            ->orderBy('posts.created_at', 'desc')
            ->get(['posts.id','posts.user_id','posts.text', 'friends.friend_id', 'users.name']);

        return view('home', compact('posts'));
    }

    public function search(){
        $search = Input::get('search');

        $users = User::where('name', 'LIKE', '%' . $search . '%')->get();

        return view('search', compact('users', 'search'));
    }
}

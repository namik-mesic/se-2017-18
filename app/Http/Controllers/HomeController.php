<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
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
        // multiple relations possible
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();

        $comments = [];
        $likes = [];
//        foreach ($posts as $post){
//            $comments[] = $post->comments();
//            $likes[] = $post->likes();
//        }

        return view('home', compact(
            'posts', 'likes', 'comments'
        ));
    }

    public function search(){
        $search = Input::get('search');

        $users = User::where('name', 'LIKE', '%' . $search . '%')->get();

        return view('search', compact('users'));
    }
}

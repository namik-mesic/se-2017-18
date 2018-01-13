<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * @return View
     */
    public function index()
    {
//        $posts = Post::orderBy('created_at', 'desc')->get();
//
//        $comments = [];
//        $likes = [];
//        foreach ($posts as $post){
//            $comments[] = $post->comments();
//            $likes[] = $post->likes();
//        }
//
//        return view('post.index', compact(
//            'posts', 'likes', 'comments'
//        ));
    }

    /**
     * @return View
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $post = Post::query()->create($data);

        return redirect()->back();
    }

    public function like(){
        return view('home');
    }
}
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

    public function create(){

    }

    public function edit(){

    }

    public function delete($id){

    }

    public function change($id){

    }

    public function like($id){

    }

    public function unlike($id){

    }

//
//    /**
//     * @return View
//     */
//    public function create()
//    {
//        return view('post.create');
//    }
//
//    /**
//     * @param Request $request
//     * @return RedirectResponse
//     */
//    public function store(Request $request)
//    {
//        $data = $request->all();
//        $data['user_id'] = Auth::user()->id;
//
//        $post = Post::query()->create($data);
//
//        return redirect()->back();
//    }
//
//    public function like(){
//        return view('home');
//    }
}
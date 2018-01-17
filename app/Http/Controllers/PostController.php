<?php

namespace App\Http\Controllers;

use App\Upvote;
use App\Post;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request){
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $post = Post::create($data);

        return redirect()->back();
    }

    public function edit(){
        return view('home');
    }

    public function delete($id){
        $post = Post::destroy($id);

        return redirect()->back();
    }

    public function change(Request $request, $id){
        $data = $request->all();

        $post = Post::find($id)->update($data);

        return redirect()->back();
    }

    public function like($id){
        $user_id = Auth::user()->id;

        $like = Upvote::create([
            'post_id' => $id,
            'user_id' => $user_id
        ]);

        return redirect()->back();
    }

    public function unlike($id){
        $post_like = Upvote::where('post_id', '=', $id, 'AND', 'user_id', '=', Auth::user()->id)->delete();

        return redirect()->back();
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
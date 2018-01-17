<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Http\Requests\CreateUserRequest;
use App\Post;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Auth;
use Illuminate\View\View;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id){
        if( $id == null ) $id = Auth::user()->$id;

        $user = User::find($id);

        $posts = Post::where('user_id', '=', $id)
            ->join('users', 'posts.user_id', 'users.id')
            ->get();

        $friends = Friend::where('user_id', '=', $id)
                    ->join('users', 'friends.friend_id', '=', 'users.id')
                    ->where('friends.status', '=', 'yes')
                    ->get();

        $requests = Friend::where('user_id', '=', Auth::user()->id)
                    ->join('users', 'friends.friend_id', '=', 'users.id')
                    ->where('friends.status', '=', 'no')
                    ->get();


        return view('profile', compact('user', 'posts', 'friends', 'requests'));
    }

    public function delete($id){
        $user = User::destroy($id);

        Auth::logout();

        return view('/');
    }

    public function change($id){

    }

    public function request($id){
        Friend::query()
            ->create([
               'user_id' => Auth::user()->id,
                'friend_id' => $id,
                'status' => 'no'
            ]);

        return redirect()->back();
    }

    public function accept($id){
        Friend::query()
            ->update([
                'user_id' => $id,
                'friend_id' => Auth::user()->id,
                'status' => 'yes'
            ]);

        Friend::query()
            ->create([
                'user_id' => Auth::user()->id,
                'friend_id' => $id,
                'status' => 'yes'
            ]);

        return redirect()->back();
    }

    public function ignore($id){
        Friend::where('user_id', '=', Auth::user()->id)
            ->where('friend_id', '=', $id)
            ->delete();

        Friend::where('friend_id', '=', Auth::user()->id)
            ->where('user_id', '=', $id)
            ->delete();

        return redirect()->back();
    }


//    /**
//     * @return View
//     */
//    public function index()
//    {
//        $users = User::all();
//
//        return view('user.index', compact(
//            'users'
//        ));
//    }
//
//    /**
//     * @return View
//     */
//    public function create()
//    {
//        return view('user.create');
//    }
//
//    /**
//     * @param CreateUserRequest $request
//     * @return RedirectResponse
//     */
//    public function store(Request $request)
//    {
//        $data = $request->all();
//        $data['password'] = bcrypt($data['password']);
//
//        $user = User::query()->create($data);
//
//        return redirect('user');
//    }
//
//    public function profile($id){
//        $user = User::find($id)->get();
//
//        $posts = User::find($id)->posts;
//
//        $friends = null;
//
//        return view('profile', compact('user', 'posts' ,'friends'));
//    }
}
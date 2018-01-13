<?php

namespace App\Http\Controllers;

use App\ProfileComment;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function getProfile() {
        $comments = ProfileComment::where('user_id', Auth::user()->id)->whereDate('created_at', DB::raw('CURDATE()'))->orderBy('created_at', 'desc')->get();

        return view('profile.index', compact('comments'));
    }

    function getProfileUpdate() {
        return view('profile.update-profile');
    }

    function updateProfile(Request $request) {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->location = $request->location;
        $user->bio = $request->bio;
        $user->avatar = $request->file('avatar');

        if($user->save()) {
            return redirect('profile');
        }
    }

    public function index()
    {
        return view('profile.index');
    }

    public function deleteProfile()
    {
        $user = User::find(Auth::user()->id);

        $user->delete();

        Auth::logout();
        return redirect('/login');
    }

    public function store(Request $request) {
        $profileComment = new ProfileComment;

        $profileComment->comment = $request->comment;
        $profileComment->user_id = Auth::user()->id;

        if ($profileComment->save()) {
            return redirect()->back();
        }
    }

    public function destroy($id) {
        $profileComment = ProfileComment::find($id);

        if ($profileComment->delete()) {
            return redirect()->back();
        }
    }
}

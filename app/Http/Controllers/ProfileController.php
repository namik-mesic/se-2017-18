<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function getProfile() {
        return view('profile.index');
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
        $users = User::all();

        return view('profile.index', compact(
            'users'
        ));
    }
}

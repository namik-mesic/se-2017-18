<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function getProfile() {
        return view('profile.index');
    }

    public function index()
    {
        $users = User::all();

        return view('user.index', compact(
            'users'
        ));
    }
}

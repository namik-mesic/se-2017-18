<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Group;
use Illuminate\Support\Facades\Input;
use App\GroupUser;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;

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

    public function search(){
        $search = Input::get('search');

        $users = User::where('name', 'LIKE', '%' . $search . '%')->get();
        $groups = Group::where('name', 'LIKE', '%' . $search . '%')->get();

        return view('search', compact('users', 'groups'));
    }

    public function index(){
        $user = User::all();
        return view('home', compact('user'));
    }
}

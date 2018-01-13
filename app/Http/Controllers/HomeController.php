<?php

namespace App\Http\Controllers;

use App\Repositories\MySQL\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\advertisements;

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
        /** @var UserRepositoryInterface $repo */
        $repo = app(UserRepositoryInterface::class);

        $repo->getByNameLike('Namik');

        $ad = advertisements::all()->random();

        return view('home', compact('ad'));
    }
}

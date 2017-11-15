<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->userRepository = app(UserRepositoryInterface::class);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->getPaginated(10, $request->get('query'));

        return view('user.index', compact(
            'users'
        ));
    }

    /**
     * @return View
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * @param CreateUserRequest $request
     * @return RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        $this->userRepository->store($request);

        return redirect('user');
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user)
    {
        return view('user.edit', compact(
            'user'
        ));
    }

    /**
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(User $user, Request $request)
    {
        $this->userRepository->update($user, $request);

        return redirect('user');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('user');
    }
}
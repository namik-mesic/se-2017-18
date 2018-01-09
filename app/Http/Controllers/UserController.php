<?php
namespace App\Http\Controllers;
use App\Http\Requests\CreateUserRequest;
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
     * @return View
     */
    public function index()
    {
        $users = User::all();
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
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::query()->create($data);
        return redirect('user');
    }
}
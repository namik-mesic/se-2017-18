<?php

namespace App\Http\Controllers\API;

use App\Repositories\MySQL\UserRepository;
use App\Transformer\UserTransformer;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 */
class UserController extends BaseController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);

        parent::__construct();
    }

    /**
     * @param Request $request
     * @return JsonResponse|string
     */
    public function index(Request $request)
    {
        $users = $this->userRepository
            ->getByNameLike($request->get('q'));

        return $this->jsonCollection($users, new UserTransformer);
    }

    /**
     * @param $authUserId
     * @param Request $request
     * @return string
     * @internal param User $user
     */
    public function getAllExceptAuth(Request $request) {

        $user = User::find($request->id);

        $users = $this->userRepository
            ->getAllExceptAuth($user, $request);

        return $this->jsonCollection($users, new UserTransformer);
    }
}
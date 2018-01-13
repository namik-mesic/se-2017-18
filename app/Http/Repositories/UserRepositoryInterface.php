<?php

namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class UserRepository
 * @package App\Repositories
 */
interface UserRepositoryInterface
{
    /**
     * @param $nameLike
     * @return Collection|static[]
     */
    public function getByNameLike($nameLike);

    /**
     * @param User $user
     * @param Request $request
     * @return mixed
     */
    public function getAllExceptAuth(User $user, Request $request);

    /**
     * @param $id
     * @return mixed
     */
    public function getAllThatAreNotInConversation($id);
}
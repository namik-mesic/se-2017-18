<?php

namespace App\Repositories\MySQL;

use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @param $nameLike
     * @return Collection|static[]
     */
    public function getByNameLike($nameLike)
    {
        return User::query()
            ->where('name', 'LIKE', "%{$nameLike}%")
            ->get();
    }
}
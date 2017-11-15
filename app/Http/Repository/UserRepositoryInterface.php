<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

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
}
<?php

namespace App\Repositories\MySQL;

use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @param Request $request
     * @return User|Builder|Model
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        return User::query()->create($data);
        
    }
    
    /**
     * @param int $perPage
     * @param null $query
     * @return User[]|LengthAwarePaginator
     */
    public function getPaginated($perPage = 10, $query = null)
    {
        $model = User::query()
            ->orderBy('users.id', 'DESC');

        if ($query)
            $model->where(function(Builder $model) use ($query) {

                $model->orWhere('users.name', 'LIKE', "%{$query}%");
                $model->orWhere('users.email', 'LIKE', "%{$query}%");
                $model->orWhere('users.id', '=', $query);

            });

        return $model->paginate($perPage);
    }
    
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

    /**
     * @return Collection|User[]
     */
    public function getAll()
    {
        return User::all();
    }

    /**
     * @param User $user
     * @param Request $request
     * @return User
     */
    public function update(User $user, Request $request)
    {
        $user->fill($request->only([
            'name',
            'email'
        ]));

        if ($password = $request->get('password'))
            $user->password = bcrypt($password);

        $user->save();

        return $user;
    }

    /**
     * @param User $user
     * @param Request $request
     * @return User[]|Collection
     */
    public function getAllExceptAuth(User $user, Request $request)
    {
        return User::where('id', '!=', $request->id)->get();
    }
}
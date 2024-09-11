<?php

namespace App\Repositories\Repository;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function search($column, $keyword, $perPage = 3)
    {
        return User::where($column, 'LIKE', '%' . $keyword . '%')->paginate($perPage);
    }

    public function paginate($perPage = 3)
    {
        return User::paginate($perPage);
    }
}

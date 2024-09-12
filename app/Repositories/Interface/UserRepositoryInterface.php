<?php

namespace App\Repositories\Interface;

use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function search($column, $keyword, $perPage = 15);
    public function paginate($perPage = 15);
}

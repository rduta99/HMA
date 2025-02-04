<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\User;

class UserRepo extends BaseRepository
{
    public function __construct(User $model) {
        $this->model = $model;
    }
}

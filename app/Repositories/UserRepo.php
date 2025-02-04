<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use {{namespacedModel}};

class UserRepo extends BaseRepository
{
    public function __construct({{m}} $model) {
        $this->model = $model;
    }
}

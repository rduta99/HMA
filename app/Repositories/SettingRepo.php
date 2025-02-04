<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Repositories\BaseRepository;

class SettingRepo extends BaseRepository
{
    public function __construct(Setting $model) {
        $this->model = $model;
    }
}

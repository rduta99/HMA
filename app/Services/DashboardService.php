<?php

namespace App\Services;

use App\Repositories\UserRepo;
use App\Services\BaseService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class DashboardService extends BaseService
{
    use ApiResponseTrait;

    protected $userRepo;

    public function __construct(UserRepo $userRepo) {
        parent::__construct();
        $this->userRepo = $userRepo;
    }

    function dashboardUserCount(): JsonResponse {
        try {
            return $this->successResponse(data: [
                'user' => $this->userRepo->raw()->count(),
                'active_user' => $this->userRepo->raw()->where('user_status', 1)->count()
            ]);
        } catch (\Throwable $th) {
            return $this->failedResponse(message: 'Error');
        }
    }
}

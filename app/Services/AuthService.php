<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Services\BaseService;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthService extends BaseService
{
    use ApiResponseTrait;

    public function __construct() {
        parent::__construct();
    }

    function loginAttempt(LoginRequest $request): JsonResponse {
        try {
            if(!Auth::attempt(['user_email' => $request->email, 'password' => $request->password])) {
                throw new Exception('Invalid credentials. Please check your username or password.', 404);
            }

            $user = Auth::user();
            $token = $user->createToken($user->user_id . '-token');
            session(['user_token' => $token]);
            $user->user_status = 1;
            $user->save();

            return $this->successResponse(message: 'Login Success');
        } catch (\Throwable $th) {
            return $this->failedResponse(message: $th->getMessage(), code: $th->getCode());
        }
    }
}

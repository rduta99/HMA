<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Services\BaseService;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthService extends BaseService
{
    use ApiResponseTrait;

    public function __construct() {
        parent::__construct();
    }

    function loginAttempt(LoginRequest $request): View {
        try {
            if(!Auth::attempt(['user_email' => $request->email, 'password' => $request->password])) {
                throw new Exception('Invalid credentials. Please check your username or password.', 404);
            }

            $user = Auth::user();
            $token = $user->createToken($user->user_id . '-token');
            session(['user_token' => $token]);
            $user->user_status = 1;
            $user->save();

            return redirect()->route('dashboard');
        } catch (\Throwable $th) {
            return back();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service) {
        $this->service = $service;
    }

    function index(): View {
        return view('auth.index');
    }

    function loginAttempt(LoginRequest $request): JsonResponse {
        return $this->service->loginAttempt($request);
    }
}

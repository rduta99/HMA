<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service) {
        $this->service = $service;
    }

    function index() {
        return view('auth.index');
    }

    function loginAttempt(LoginRequest $request) {
        return $this->service->loginAttempt($request);
    }

    function logout() {
        $user = auth()->user();
        $user->user_status = 0;
        $user->save();

        Auth::logout();
        session()->flush();

        return redirect()->route('login');
    }
}

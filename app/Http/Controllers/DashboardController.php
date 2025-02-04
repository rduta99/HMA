<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $service;

    public function __construct(DashboardService $service) {
        parent::__construct();
        $this->service = $service;
    }

    function index() {
        return view('dashboard.index', $this->data);
    }

    function dashboardUserCount(): JsonResponse {
        return $this->service->dashboardUserCount();
    }
}

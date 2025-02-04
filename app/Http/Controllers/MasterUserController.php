<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Services\MasterUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MasterUserController extends Controller
{
    protected $service;

    public function __construct(MasterUserService $service) {
        $this->service = $service;
    }

    function index() {
        return view('user.index');
    }

    function create() {
        return view('user.create');
    }

    function createProcess(StoreUserRequest $request) {
        if($this->service->createUser($request))
            return redirect()->route('master.user');

        return back();
    }

    function detail($id) {
        $data['user'] = $this->service->userDetail($id);
        $data['user_id'] = $id;

        return view('user.detail', $data);
    }

    function updateUser(Request $request) {

    }

    function deleteUser($id) {
        if($this->service->deleteUser($id))
            return redirect()->route('master.user')->with('msg', "User Deleted");

        return back()->with('msg', 'Fail to delete data');
    }

    function userList(Request $request): JsonResponse {
        return $this->service->userList($request);
    }
}

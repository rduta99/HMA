<?php

namespace App\Services;

use App\Repositories\UserRepo;
use App\Services\BaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class MasterUserService extends BaseService
{
    protected $userRepo;

    public function __construct(UserRepo $userRepo) {
        parent::__construct();
        $this->userRepo = $userRepo;
    }

    function userList(): JsonResponse {
        return DataTables::of($this->userRepo->get())->make(true);
    }

    function createUser(Request $request) {
        try {
            if($this->userRepo->create([
                'user_email' => $request->user_email,
                'user_fullname' => $request->user_fullname,
                'password' => Hash::make($request->user_password),
            ]))
                return true;

            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    function deleteUser($id) {
        return $this->userRepo->delete(['user_id' => $id]);
    }

    function userDetail($id) {
        return $this->userRepo->find($id);
    }
}

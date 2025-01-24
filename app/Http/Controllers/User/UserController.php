<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\DeleteUserRequest;
use App\Http\Requests\User\Auth\UpdateUserPasswordRequest;
use App\Http\Requests\User\Auth\UpdateUserProfileRequest;
use App\Services\User\UserService;

class UserController extends Controller
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function showProfile()
    {
        $res = $this->service->showProfile();

        return $this->sendResponse(message: 'Your Profile', data: $res);
    }

    public function updateProfile(UpdateUserProfileRequest $request)
    {
        $data = $request->validated();

        $res = $this->service->updateProfile($data);

        return $this->sendResponse(message: 'Profile Updated Successfully', data: $res);
    }

    public function deleteProfile(DeleteUserRequest $request)
    {
        $data = $request->validated();

        $res = $this->service->deleteProfile($data);

        return $this->sendResponse(message: 'profile deleted successfully', data: $res);
    }

    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $data = $request->validated();

        $res = $this->service->updatePassword($data);

        return $this->sendResponse(message: 'password updated successfully', data: $res);
    }


}

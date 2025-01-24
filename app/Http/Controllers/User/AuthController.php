<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\LoginUserRequest;
use App\Http\Requests\User\Auth\RegisterUserRequest;
use App\Http\Requests\User\Auth\ResetPasswordRequest;
use App\Http\Requests\User\Auth\SendVerifyOtpRequest;
use App\Http\Requests\User\Auth\VerifyOtpRequest;
use App\Services\User\AuthService;

class AuthController extends Controller
{

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();

        $res = $this->service->register($data);

        return $this->sendResponse(message: 'register complete email verification sent', data: $res);
    }

    public function login(LoginUserRequest $request)
    {
        $data = $request->validated();

        $res = $this->service->login($data);

        return $this->sendResponse(message: 'logged in successfully', data: $res);
    }

    public function logout()
    {
        $this->service->logout();

        return $this->sendResponse(message: 'logged out successfully');
    }


    public function verifyEmailOtp(VerifyOtpRequest $request)
    {
        $data = $request->validated();

        $res = $this->service->verifyEmailOtp($data);

        return $this->sendResponse(message: 'Email Verified Successfully', data: $res);
    }


    public function sendOtpForResetPassword(SendVerifyOtpRequest $request)
    {
        $user = $request->user;

        $res = $this->service->sendOtpForResetPassword($user);

        return $this->sendResponse(message: 'otp code sent to your email', data:$res);
    }

    public function verifyPasswordOtp(VerifyOtpRequest $request)
    {
        $data = $request->validated();

        $res = $this->service->verifyPasswordOtp($data);

        return $this->sendResponse(message: 'Use This Token For Reset Password In 5 Min', data: $res);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $data = $request->validated();

        $res = $this->service->resetPassword($data);

        return $this->sendResponse(message:'password rested successfully', data: $res);
    }


    public function resendOtp(SendVerifyOtpRequest $request)
    {
        $user = $request->user;

        $this->service->resendOtp($user);

        return $this->sendResponse(message: 'new otp sent');
    }
}

<?php

namespace App\Services\User;

use App\Exceptions\CustomExceptionWithMessage;
use App\Exceptions\UnverifiedEmailException;
use App\Exceptions\WrongPasswordException;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Models\VerifyOtp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function register($data)
    {
        $user = $this->model::create($data);

        $this->sendOtp($user, 'email');

        return new UserResource($user);
    }

    public function login($data)
    {
        $user = User::where('email', $data['email'])->first();

        if ($user->email_verified_at === null)
        {
            throw new UnverifiedEmailException();
        }

        if ($user->status !== 'active')
        {
            throw new CustomExceptionWithMessage('Inactive User');
        }

        if(!Hash::check ($data['password'], $user->password))
        {
            throw new WrongPasswordException();
        }

        $token = $user->createToken('user-token', ["all"])->plainTextToken;

        return [
            'user' => new UserResource($user),
            'token' => $token
        ];
    }

    public function logout()
    {
        auth('users')->user()->currentAccessToken()->delete();

        return true;
    }

    /**
     * Forget Password
     */
    public function sendOtpForResetPassword($user)
    {
        if(!$user->email_verified_at)
            throw new CustomExceptionWithMessage('not verified email');

        $this->resendOtp($user);

        return true;
    }

    public function verifyPasswordOtp($data)
    {
        $user = User::where('email', $data['email'])->first();

        $this->verifyOtp($user, $data['otp'], 'password');

        $token = $user->createToken('token-name', ['reset-password'], now()->addMinute(5))->plainTextToken;;

        return [
            'token' => $token
        ];
    }

    public function resetPassword($data)
    {
        $user = auth('users')->user();

        $user->update([
            'password' => $data['password']
        ]);

//        $user->tokens()->delete();

        $token = $user->createToken('user-token')->plainTextToken;

        return [
            'user' => new UserResource($user),
            'token' => $token
        ];
    }


    /**
     * Email Verification
     */
    public function verifyEmailOtp($data)
    {
        $user = User::where('email', $data['email'])->first();

        $this->verifyOtp($user, $data['otp'], 'email');

        $user->markEmailAsVerified();

        $token = $user->createToken('user-token', ["all"])->plainTextToken;

        return [
            'user' => new UserResource($user),
            'token' => $token
        ];
    }

    public function resendOtp($user)
    {
        $verifyOtp = $user->verifyOtp;
        $type = $user->email_verified_at === null ? 'email' : 'password';

        if($verifyOtp === null)
            $this->sendOtp($user, $type);

        else if($verifyOtp->end_at > now())
            throw new CustomExceptionWithMessage('You Must Wait 5 Min From Last Otp Sent');

        else
            $this->sendOtp($user, $type);
    }




    public function verifyOtp($user, $otp, $type)
    {
        $verifyOtp = $user->verifyOtp;

        if ($verifyOtp === null)
            throw new CustomExceptionWithMessage('You Dont Have Otp Code');

        if($verifyOtp->type !== $type)
            throw new CustomExceptionWithMessage('Wrong Otp Type');

        if($verifyOtp->end_at < now())
            throw new CustomExceptionWithMessage('Otp Expired');

        if($verifyOtp->otp !== $otp)
            throw new CustomExceptionWithMessage('Wrong Otp');

        $verifyOtp->update([
            'end_at' => now()
        ]);
    }

    public function sendOtp($user, $type)
    {
        $otp = Str::random(10);

        $v = VerifyOtp::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'type' => $type,
            'end_at' => now()->addMinutes(5)
        ]);

//        Mail::to($user->email)->queue(new SendOtpEmail($user->email, $otp));
    }

}

<?php

namespace App\Services\User;

use App\Exceptions\WrongPasswordException;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use FileTrait;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function showProfile()
    {
        return new UserResource(auth('users')->user());
    }

    public function updateProfile($data)
    {
        $user = auth('users')->user();


        if(isset($data['image']))
        {
            $url = $this->uploadFile('public', 'profiles-images', $data['image']);

            if(!$user->image)
            {
                $user->image()->create(['url' => $url]);
                $user->refresh();
            }
            else
            {
                $this->deleteFile('public', $user->image->url);
                $user->image()->update(['url' => $url]);
                $user->refresh();
            }
        }

        else if(isset($data['delete_image']))
        {
            $this->deleteFile('public', $user->image->url);
            $user->image()->delete();
            $user->refresh();
        }


        $user->update($data);

        return new UserResource($user);
    }

    public function updatePassword($data)
    {
        $user = auth('users')->user();

        if(!Hash::check ($data['old_password'], $user->password))
        {
            throw new WrongPasswordException();
        }

        $user->update([
            'password' => $data['new_password']
        ]);

        return true;
    }

    public function deleteProfile($data)
    {
        $user = auth('users')->user();

        if(!Hash::check ($data['password'], $user->password))
        {
            throw new WrongPasswordException();
        }

        $user->tokens()->delete();

        $user->delete();

        return true;
    }
}

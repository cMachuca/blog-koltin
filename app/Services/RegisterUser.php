<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterUser
{
    /**
     * @param array $userData
     * @return User
     */
    public function __invoke(array $userData): User
    {
        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'slug_name' => Str::slug($userData['name']),
        ]);

        event(new Registered($user));

        return $user;
    }

}

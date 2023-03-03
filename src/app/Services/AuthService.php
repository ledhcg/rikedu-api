<?php
namespace App\Services;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    const TOKEN_NAME = 'APPLICATION';

    public function attemptLogin($input)
    {
        $emailUsername = $input['email_username'];
        $password = $input['password'];

        $credentials = [
            filter_var($emailUsername, FILTER_VALIDATE_EMAIL)
                ? 'email'
                : 'username' => $emailUsername,
            'password' => $password,
        ];

        return Auth::attempt($credentials);
    }
}

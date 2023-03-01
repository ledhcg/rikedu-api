<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

define('APPLICATION', 'APP');

use App\Traits\ApiResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;

class AuthController extends Controller
{
    use ApiResponse;
    
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    /**
     * Register
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $input = $request->validated();
        $input['password'] = bcrypt($input['password']);
        $input['image'] = $this->authService->handleImage($input['image']);
        $user = User::create($input);
        //Assign role
        $user->assignRole('user');
        //Create token
        $data['auth'] = [
            'access_token' => $user->createToken(APPLICATION)->plainTextToken,
            'token_type' => 'Bearer',
        ];
        $data['user'] = $user;
        return $this->successResponse($data, 'User register successfully');
    }

    /**
     * Login
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        if ($this->authService->attemptLogin($request->validated())) {
            $user = Auth::user();
            $data['auth'] = [
                'access_token' => $user->createToken(APPLICATION)
                    ->plainTextToken,
                'token_type' => 'Bearer',
            ];
            $data['user'] = $user;
            $data['role'] = $user->getRoleNames();
            // Permissions inherited from the user's roles
            $data['permission'] = $user->getPermissionsViaRoles();

            return $this->successResponse($data, 'User login successfully');
        } else {
            return $this->unauthorizedResponse('Unauthorized');
        }
    }

    /**
     * Logout (revoke the token).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request
            ->user()
            ->currentAccessToken()
            ->delete();

        return $this->deletedResponse('User logged out successfully');
    }
}
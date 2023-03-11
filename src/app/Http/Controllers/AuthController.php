<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\ApiResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use App\Services\UserService;
use App\Contracts\ModeQuery;
use App\Contracts\StoragePath;

class AuthController extends Controller
{
    use ApiResponse;

    private $authService, $userService;

    public function __construct(
        AuthService $authService,
        UserService $userService
    ) {
        $this->authService = $authService;
        $this->userService = $userService;
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
        $input['image'] = $this->userService->processImage(
            $input['image'],
            StoragePath::USER_IMAGE_AVATAR
        );

        $user = User::create($input);
        //Assign role
        $user->assignRole('user');
        //Create token
        $user->authentication = [
            'access_token' => $user->createToken(AuthService::TOKEN_NAME)
                ->plainTextToken,
            'token_type' => 'Bearer',
        ];
        $user->modeQuery = ModeQuery::MODEL_SINGLE;

        return $this->successResponse(
            new UserResource($user),
            'User register successfully'
        );
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
            $user->authentication = [
                'access_token' => $user->createToken(AuthService::TOKEN_NAME)
                    ->plainTextToken,
                'token_type' => 'Bearer',
            ];
            $user->modeQuery = ModeQuery::MODEL_SINGLE;

            return $this->successResponse(
                new UserResource($user),
                'User login successfully'
            );
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

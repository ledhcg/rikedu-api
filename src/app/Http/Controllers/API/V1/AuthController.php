<?php

namespace App\Http\Controllers\API\V1;

define('APPLICATION', 'APP');
use Illuminate\Http\Request;
use App\Traits\API\V1\ApiResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * Register
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $this->validationErrorResponse(
                'Validation failed',
                $validator->errors()
            );
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
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
    public function login(Request $request)
    {
        if (
            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])
        ) {
            $user = Auth::user();
            $data['auth'] = [
                'access_token' => $user->createToken(APPLICATION)
                    ->plainTextToken,
                'token_type' => 'Bearer',
            ];
            $data['user'] = $user;

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

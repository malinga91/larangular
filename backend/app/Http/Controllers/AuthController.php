<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.jwt:api', ['except' => ['login', 'signup']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                $data = [
                    'status' => 'error',
                    'data'  => [
                        'error' => "Invalid Credentials"
                    ]
                ];
                return response()->json($data, 401);
            }
        } catch (JWTException $e) {

            // something went wrong whilst attempting to encode the token
            $data = [
                'status' => 'error',
                'data'  => [
                    'error' => "Could not create token"
                ]
            ];
            return response()->json($data, 500);
        }

        $data = [
            'success' => true,
            'message' => 'User logged successfully',
            'data'  => [
                'access_token' => $token,
                'user' => auth()->user()
            ]
        ];

        // all good so return the token
        return response()->json($data);

    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ];

        $user = User::create($data);

        return response()->json([
            'success' => true,
            'message' => 'User successfully created!',
            'data' => $user
        ], 201);


    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $data = [
            'success' => 'true',
            'data'  => [
                'user' => JWTAuth::toUser()
            ]
        ];
        return response()->json($data);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->name
        ]);
    }
}
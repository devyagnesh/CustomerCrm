<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\NewAccessToken;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'status' => 400,
                'message' => $validator->errors()->first(),
            ]);
        }

        if ($this->auth->attempt($credentials)) {
            $user = $this->auth->user();

          
            $token = $user->createToken('access_token');
            
            $user->api_token = $token->token;
            $user->save(); 
        
            return response()->json([
                'access_token' => $token->token,
                'token_type' => 'Bearer',
                'expires_in' => $token->expires_at,
            ]);
        } else {
            return response()->json([
                'error' => true,
                'status' => 400,
                'message' => 'Unauthorized',
            ]);
        }
    }
}

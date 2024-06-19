<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Repositories\UserRepository;

class AuthController extends \App\Http\Controllers\Controller
{
  protected $user;

  public function __construct(UserRepository $user)
  {
    $this->user = $user;
  }

  public function register(Request $request): JsonResponse
  {
    $validator = Validator::make($request->all(), [
      'username' => 'required|string|max:255',
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
      'password_confirmation' => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 422);
    }

    $model = $this->user->create([
      'username' => $request->username,
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    $token = auth()->login($model);

    return response()->json([
      'status' => 200,
      'message' => 'User has been successfully registered',
      'data' => $this->respondWithToken($token),
    ], 200);
  }

  public function login(Request $request): JsonResponse
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|string|email|max:255',
      'password' => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 422);
    }

    $credentials = $request->only('email', 'password');

    if (!$token = auth()->attempt($credentials)) {
      return response()->json([
        'status' => 401,
        'message' => 'Invalid credentials',
        'data' => null
      ], 401);
    }

    return response()->json([
      'status' => 200,
      'message' => 'User has been logged in',
      'data' => $this->respondWithToken($token)
    ], 200);
  }

  public function me(): JsonResponse
  {
    if (!auth()->user()) {
      return response()->json([
        'status' => 401,
        'message' => 'Unauthorized',
        'data' => null
      ], 401);
    }

    return response()->json([
      'status' => 200,
      'message' => 'User data',
      'data' => auth()->user()
    ], 200);
  }

  public function logout(): JsonResponse
  {
    auth()->logout();

    return response()->json([
      'status' => 200,
      'message' => 'User has been successfully logged out',
      'data' => null,
    ], 200);
  }

  protected function respondWithToken($token)
  {
    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60
    ]);
  }
}
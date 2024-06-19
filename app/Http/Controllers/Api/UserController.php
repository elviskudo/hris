<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

use App\Repositories\UserRepository;

class UserController extends \App\Http\Controllers\Controller
{
  protected $users;

  public function __construct (UserRepository $users)
  {
    $this->users = $users;
  }

  public function list (Request $request): JsonResponse
  {
    $users = $this->users->list($request->all());

    return response()->json([
        'status' => 200,
        'message' => 'Users retrieved successfully',
        'data' => $users
    ], 200);
  }

  public function update ($id, Request $request): JsonResponse
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 422);
    }

    $model = $this->users->update($id, $request->all());

    return response()->json([
      'status' => 200,
      'message' => 'User updated successfully',
      'data' => $model
    ], 200);
  }
}
<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

use App\Repositories\CategoryRepository;

class CategoryController extends \App\Http\Controllers\Controller
{
  protected $categories;

  public function __construct (CategoryRepository $categories)
  {
    $this->categories = $categories;
  }

  public function list (Request $request): JsonResponse
  {
    $categories = $this->categories->list($request->all());

    return response()->json([
        'status' => 200,
        'message' => 'Categories retrieved successfully',
        'data' => $categories
    ], 200);
  }

  public function create (Request $request): JsonResponse
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 422);
    }

    $model = $this->categories->create($request->all());

    return response()->json([
      'status' => 200,
      'message' => 'Category has been created successfully',
      'data' => $model
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

    $model = $this->categories->update($id, $request->all());

    return response()->json([
      'status' => 200,
      'message' => 'Category has been updated successfully',
      'data' => $model
    ], 200);
  }

  public function delete ($id)
  {
    $model = $this->categories->delete($id);

    return response()->json([
      'status' => 200,
      'message' => 'Category has been deleted successfully',
      'data' => $model
    ], 200);
  }
}
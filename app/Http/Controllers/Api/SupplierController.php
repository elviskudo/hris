<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

use App\Repositories\SupplierRepository;

class SupplierController extends \App\Http\Controllers\Controller
{
  protected $suppliers;

  public function __construct (SupplierRepository $suppliers)
  {
    $this->suppliers = $suppliers;
  }

  public function list (Request $request): JsonResponse
  {
    $suppliers = $this->suppliers->list($request->all());

    return response()->json([
        'status' => 200,
        'message' => 'Suppliers retrieved successfully',
        'data' => $suppliers
    ], 200);
  }

  public function create (Request $request): JsonResponse
  {
    $validator = Validator::make($request->all(), [
      'code' => 'required|string|max:8',
      'name' => 'required|string|max:255',
      'address' => 'string',
      'pic_name' => 'required|string|max:255',
      'pic_phone' => 'required|string|max:20',
      'pic_npwp' => 'string'
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 422);
    }

    $model = $this->suppliers->create($request->all());

    return response()->json([
      'status' => 200,
      'message' => 'Supplier has been created successfully',
      'data' => $model
    ], 200);
  }

  public function update ($id, Request $request): JsonResponse
  {
    $validator = Validator::make($request->all(), [
      'code' => 'required|string|max:8',
      'name' => 'required|string|max:255',
      'address' => 'string',
      'pic_name' => 'required|string|max:255',
      'pic_phone' => 'required|string|max:20',
      'pic_npwp' => 'string'
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 422);
    }

    $model = $this->suppliers->update($id, $request->all());

    return response()->json([
      'status' => 200,
      'message' => 'Supplier has been updated successfully',
      'data' => $model
    ], 200);
  }
}
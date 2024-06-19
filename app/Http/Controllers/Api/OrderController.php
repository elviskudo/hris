<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

use App\Repositories\OrderRepository;

class OrderController extends \App\Http\Controllers\Controller
{
  protected $orders;

  public function __construct (OrderRepository $orders)
  {
    return $this->orders = $orders;
  }

  public function list (Request $request): JsonResponse
  {
    $model = $this->orders->list($request->all());

    return response()->json([
        'status' => 200,
        'message' => 'orders retrieved successfully',
        'data' => $model
    ], 200);
  }

  public function create (Request $request): JsonResponse
  {
    $validator = Validator::make($request->all(), [
      'user_id' => 'required|integer',
      'product_id' => 'required|integer',
      'code' => 'required|string|max:8',
      'quantity' => 'required|integer',
      'transaction_date' => 'required|datetime'
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 422);
    }

    $model = $this->orders->create($request->all());

    return response()->json([
      'status' => 200,
      'message' => 'Order has been created successfully',
      'data' => $model
    ], 200);
  }

  public function update ($id, Request $request): JsonResponse
  {
    $validator = Validator::make($request->all(), [
      'user_id' => 'required|integer',
      'product_id' => 'required|integer',
      'code' => 'required|string|max:8',
      'quantity' => 'required|integer',
      'transaction_date' => 'required|datetime'
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 422);
    }

    $model = $this->orders->update($id, $request->all());

    return response()->json([
      'status' => 200,
      'message' => 'Order has been updated successfully',
      'data' => $model
    ], 200);
  }

  public function delete ($id)
  {
    $model = $this->orders->delete($id);

    return response()->json([
      'status' => 200,
      'message' => 'Order has been deleted successfully',
      'data' => $model
    ], 200);
  }
}
<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

use App\Repositories\ProductRepository;

class ProductController extends \App\Http\Controllers\Controller
{
    protected $products;

    public function __construct (ProductRepository $products)
    {
        $this->products = $products;
    }

    public function list (Request $request): JsonResponse
    {
        $products = $this->products->list();

        return response()->json([
            'status' => 200,
            'message' => 'Products retrieved successfully',
            'data' => $products
        ], 200);
    }

    public function create (Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|integer',
            'category_id' => 'required|integer',
            'code' => 'required|string|max:8',
            'name' => 'required|string|max:255',
            'price' => 'integer',
            'stock' => 'integer',
            'description' => 'string',
            'image_url' => 'string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $model = $this->products->create($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Product has been created successfully',
            'data' => $model
        ], 200);
    }

    public function update ($id, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|integer',
            'category_id' => 'required|integer',
            'code' => 'required|string|max:8',
            'name' => 'required|string|max:255',
            'price' => 'integer',
            'stock' => 'integer',
            'description' => 'string',
            'image_url' => 'string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $model = $this->products->update($id, $request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Product has been updated successfully',
            'data' => $model
        ], 200);
    }
}

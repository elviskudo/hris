<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\ProductsImport;
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
        $perPage = $params['per_page'] ?? 20;
        $search = $params['q'] ?? null;
        $orderBy = $params['order_by'] ?? null;

        $products = $this->products->list($perPage, $search, $orderBy);

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

    public function upload (Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'file' => ['required', 'mimes:csv,xls,xlsx'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => $validator->errors(),
                    'data' => null
                ], 422);
            }

            // get file
            $file = $request->file('file');
     
            // make file name
            $fileName = rand() . $file->getClientOriginalName();
     
            // upload to folder public/import
            $file->move('imports', $fileName);
     
            // import data
            Excel::import(new ProductsImport, public_path('/imports/' . $fileName));

            return response()->json([
                'status' => 200,
                'message' => 'Products has been uploaded successfully.',
                'data' => $fileName
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->errors(),
                'data' => null
            ], 422);
        } catch (\Exception $e) {
            $statusCode = ($e->getCode() > 100 && $e->getCode() < 600) ? $e->getCode() : 500;

            return response()->json([
                'status' => $statusCode,
                'message' => $e->getMessage(),
                'data' => null
            ], $statusCode);
        }
    }

    public function update ($id, Request $request): JsonResponse
    {
        try {
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
        } catch (ValidationException $e) {
            return response()->json([
            'status' => 422,
            'message' => $e->errors(),
            'data' => null
        ], 422);
    } catch (\Exception $e) {
        $statusCode = ($e->getCode() > 100 && $e->getCode() < 600) ? $e->getCode() : 500;

        return response()->json([
            'status' => $statusCode,
            'message' => $e->getMessage(),
            'data' => null
        ], $statusCode);
        }
    }

    public function delete ($id)
    {
        try {
            $model = $this->products->delete($id);

            return response()->json([
                'status' => 200,
                'message' => 'Product has been deleted successfully',
                'data' => $model
            ], 200);
        } catch (\Exception $e) {
            $statusCode = ($e->getCode() > 100 && $e->getCode() < 600) ? $e->getCode() : 500;

            return response()->json([
                'status' => $statusCode,
                'message' => $e->getMessage(),
                'data' => null
            ], $statusCode);
        }
    }
}

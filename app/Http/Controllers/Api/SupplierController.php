<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
    try {
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

  public function uploadDataFromXls (Request $request): JsonResponse
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
        Excel::import(new SuppliersImport, public_path('/imports/' . $fileName));

        return response()->json([
            'status' => 200,
            'message' => 'Suppliers has been uploaded successfully.',
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

  public function delete ($id): JsonResponse
  {
    try {
      $model = $this->suppliers->delete($id);

      return response()->json([
        'status' => 200,
        'message' => 'Supplier has been deleted successfully',
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
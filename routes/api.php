<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;

Route::get('/test', function () {
    return 'test';
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(
    ['middleware' => 'jwt.auth'],
    function ($router) {
        // user
        $router->get('/me', [AuthController::class, 'me']);
        $router->post('/logout', [AuthController::class, 'logout']);

        // categories
        Route::group(['prefix' => 'categories'], function ($router) {
            $router->get('/list', [CategoryController::class, 'list']);
            $router->post('/create', [CategoryController::class, 'create']);
            $router->put('/update/{id}', [CategoryController::class, 'update']);
        });

        // product
        Route::group(['prefix' => 'products'], function ($router) {
            $router->get('/list', [ProductController::class, 'list']);
            $router->post('/create', [ProductController::class, 'create']);
            $router->put('/update/{id}', [ProductController::class, 'update']);
            $router->post('/upload', [ProductController::class, 'upload']);
        });

        // supplier
        Route::group(['prefix' => 'suppliers'], function ($router) {
            $router->get('/list', [SupplierController::class, 'list']);
            $router->post('/create', [SupplierController::class, 'create']);
            $router->put('/update/{id}', [SupplierController::class, 'update']);
            $router->post('/upload', [SupplierController::class, 'upload']);
        });

        // order
        Route::group(['prefix' => 'orders'], function ($router) {
            $router->get('/list', [OrderController::class, 'list']);
            $router->post('/create', [OrderController::class, 'create']);
            $router->put('/update/{id}', [OrderController::class, 'update']);
            $router->delete('/delete/{id}', [OrderController::class, 'delete']);
            $router->post('/summary', [OrderController::class, 'summary']);
            $router->post('/export', [OrderController::class, 'export']);
        });

        // user
        Route::group(['prefix' => 'users'], function ($router) {
            $router->get('/list', [UserController::class, 'list']);
            $router->put('/update/{id}', [UserController::class, 'update']);
        });
    }
);
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
        $router->get('/categories', [CategoryController::class, 'list']);
        $router->post('/categories', [CategoryController::class, 'create']);

        // product
        $router->get('/products', [ProductController::class, 'list']);
        $router->post('/products', [ProductController::class, 'create']);

        // supplier
        $router->get('/suppliers', [SupplierController::class, 'list']);
        $router->post('/suppliers', [SupplierController::class, 'create']);
        $router->put('/suppliers/{id}', [SupplierController::class, 'update']);

        // order
        $router->get('/orders', [OrderController::class, 'list']);
        $router->post('/orders', [OrderController::class, 'create']);
        $router->put('/orders/{id}', [OrderController::class, 'update']);
        $router->delete('/orders/{id}', [OrderController::class, 'delete']);

        // user
        $router->get('/users', [UserController::class, 'list']);
        $router->put('/users/{id}', [UserController::class, 'update']);
    }
);
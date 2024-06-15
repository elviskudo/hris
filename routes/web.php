<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return phpinfo();
    // return view('welcome');
});

<?php

use Illuminate\Support\Facades\Route;


use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function () {
    return '404 Not found';
});


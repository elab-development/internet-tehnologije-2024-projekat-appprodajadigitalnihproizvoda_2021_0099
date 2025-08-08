<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\API\AuthController;
use App\Http\Middleware\IsAdmin;

//Rute za korisnike
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);   
Route::delete('/users/{id}', [UserController::class, 'destroy']);

//Rute za kategorije
Route::middleware(['auth:sanctum', IsAdmin::class])->group(function () {

Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']); 
});
//Rute za prikaz kategorija koje ce sluziti za filtriranje na frontu
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
//Rute za recepte
Route::get('/recipes', [RecipeController::class, 'index']);
Route::get('/recipes/{id}', [RecipeController::class, 'show']);
Route::post('/recipes', [RecipeController::class, 'store']);
Route::put('/recipes/{id}', [RecipeController::class, 'update']);
Route::delete('/recipes/{id}', [RecipeController::class, 'destroy']);

//Rute za autentifikaciju
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
//mora ruta da bude zasticena jer samo prijavljeni korisnici mogu da se odjave
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

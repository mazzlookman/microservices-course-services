<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post("/mentors", [\App\Http\Controllers\MentorController::class, "create"]);
Route::get("/mentors", [\App\Http\Controllers\MentorController::class, "getAll"]);
Route::patch("/mentors/{id}", [\App\Http\Controllers\MentorController::class, "update"]);
Route::get("/mentors/{id}", [\App\Http\Controllers\MentorController::class, "getById"]);
Route::delete("/mentors/{id}", [\App\Http\Controllers\MentorController::class, "remove"]);

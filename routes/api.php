<?php
use App\Http\Controllers\API\V1\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// This requires authentication (login), uncomment if you want to use Sanctum for API authentication
// Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
//     Route::apiResource('tasks', TaskController::class);
// });

Route::prefix('v1')->group(function () {
    Route::apiResource('tasks', TaskController::class);
});
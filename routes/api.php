<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Get Products Data
Route::get('productList',[ApiController::class,'productList']);

// Create Data
Route::post('createData',[ApiController::class,'createData']);

// Delete Data
// By post method
Route::post('deleteDataPost',[ApiController::class,'deleteDataPost']);
// By get method
Route::get('deleteDataGet/{id}',[ApiController::class,'deleteDataGet']);

// Update Data
Route::post('updateData',[ApiController::class,'updateData']);

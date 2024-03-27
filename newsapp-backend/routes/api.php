<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsItemController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route for fetching all news items
Route::get('/news-items', [NewsItemController::class, 'index']);

// Route for fetching a single news item by ID
Route::get('/news-items/{id}', [NewsItemController::class, 'show']);

// Route for creating a new news item
Route::post('/news-items', [NewsItemController::class, 'store']);

// Route for updating an existing news item
Route::put('/news-items/{id}', [NewsItemController::class, 'update']);

// Route for deleting a news item
Route::delete('/news-items/{id}', [NewsItemController::class, 'destroy']);

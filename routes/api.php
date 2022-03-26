<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use App\Http\Controllers\BookController;

Route::middleware('api')->group(function () {
    Route::get('books', [BookController::class, 'index']);
    Route::post('comment', [BookController::class, 'storeComment']); 
    Route::get('comments', [BookController::class, 'showComments']);
    Route::get('get-comments-count', [BookController::class, 'getCommentsCount']);
    Route::get('characters', [BookController::class, 'getCharacters']);
});
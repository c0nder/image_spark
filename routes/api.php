<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SearchController;
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

Route::middleware('auth:api')->group(function () {
    Route::apiResources([
        'authors' => AuthorController::class,
        'books' => BookController::class
    ]);

    Route::get('search', [SearchController::class, 'search']);

    Route::post('books/{book}/estimate', [BookController::class, 'estimate']);
    Route::post('authors/{author}/estimate', [AuthorController::class, 'estimate']);
});

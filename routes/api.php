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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('subscribers', [App\Http\Controllers\SubscriberController::class, 'index'])->name('subscriber.index');
    Route::post('subscribers', [App\Http\Controllers\SubscriberController::class, 'store'])->name('subscriber.store');
    Route::get('subscribers/{subscriber}', [App\Http\Controllers\SubscriberController::class, 'show'])->name('subscriber.show');
    Route::get('fields', [App\Http\Controllers\FieldController::class, 'index'])->name('field.index');
    Route::post('fields', [App\Http\Controllers\FieldController::class, 'store'])->name('field.store');
    Route::get('fields/{field}', [App\Http\Controllers\FieldController::class, 'show'])->name('field.show');
});
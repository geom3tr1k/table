<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OfferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/client', [ClientController::class, 'addClient']);
Route::get('/client', [ClientController::class, 'getClient']);
Route::patch('/client/{id}', [ClientController::class, 'updateClient']);
Route::delete('/client/{id}', [ClientController::class, 'delClient']);
Route::get('/export-users', [ClientController::class, 'exportUsers']);


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\CollectionController;

Route::apiResource('media', MediaController::class);

Route::post('/users/{user}/collection/{media}', [CollectionController::class, 'store']);

Route::get('/users/{user}/collection', [CollectionController::class, 'index']);

Route::delete('/users/{user}/collection/{media}', [CollectionController::class, 'destroy']);
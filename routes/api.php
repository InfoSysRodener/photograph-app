<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\UserController;
use App\Models\Album;
use App\Models\Capture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::apiResource('user',UserController::class);
Route::apiResource('album',AlbumController::class);

Route::get('/generateQRCodeUrl',function(){
    return 'Generate QR Code';
});


Route::get('/albums',function(){
    $album = Album::with('capture')->find(2);
    return $album;
});
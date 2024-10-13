<?php

use Illuminate\Support\Facades\Route;
use LaravelQRCode\Facades\QRCode;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/qr-code',function (){
    $filename = '/qr-code';
    $extention = '.png';
    $path = storage_path(). $filename . $extention;
 
    QRCode::url('https://photographer/')
    ->setSize(8)
    ->setMargin(2)
    ->setOutfile($path)
    ->png();

    $qrImage =  file_get_contents($path);

    $qrcode_name =  Str::random(5) . $extention; 

    Storage::disk('s3')->put('qrcode/' . $qrcode_name, $qrImage,['ACL' => 'public-read']);
    return '<img src=' .  $qrImage  . '>';

});
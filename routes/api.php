<?php

use App\Classes\ApiResponseClass;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CaptureController;
use App\Http\Controllers\UserController;
use App\Models\Remote;
use App\Models\Venue;
use App\Models\User;
use App\Models\Album;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

use LaravelQRCode\Facades\QRCode;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::apiResource('user',UserController::class);
Route::apiResource('album',AlbumController::class);
Route::apiResource('capture',CaptureController::class)->only(['index','show']);


Route::get('/notifyAllAlbumUsers', function(Request $request) {

    $album_id = $request->get('album_id');
    $users = User::where('album_id',$album_id)->get();

    foreach($users as $user){
        Mail::to($user->email)->queue( new App\Mail\Album($user));
    }  

    return ApiResponseClass::sendResponse('','Successfully Send',200);
});


Route::post('/generateQRCodeUserToAlbum', function(Request $request){
    //invite friend qrcode (new user & same album_id) when scan
    //add new column on album
    //check if album has qr code 
    // generate qr_code
    // update album qrcode_image
    //just add-user-associated-with-album 
    //redirect on album page     
    //format https://domain.com/photographer/album/album_id/user/user_id/token

    $album_id = $request->get('album_id');

    $album = Album::findOrFail($album_id);
    
    if (empty($album->qrcode_image)) {
     
        $user = User::create([
            'album_id' => $album_id,
            'name' => 'scanned_friend_invite',
            'email' => 'scanned_email' . Str::random(5) . '@gmail.com' ,
            'password' => 'scanned_password' . Str::random(3)
        ]);
    
        $filename = '/qr-code';
        $extention = '.png';
        $path = storage_path(). $filename . $extention;
        $qrcode_name =  Str::random(5) . $extention; 

        $qrcode_image ='https://photographer.s3.ap-southeast-1.amazonaws.com/qrcode/'. $qrcode_name; 

        //update album 
        Album::where('id' ,$album_id)->update(['qrcode_image' => $qrcode_image]);

        $token = hash('sha256', 'SALT123+' . $user->id . '+' . $album_id);
    
        $url = 'http://localhost:5173/photographer/album/' . $album_id . '/' . 'user' . '/' . $user->id .'/' . $token . '';
     
        QRCode::url($url)
        ->setSize(8)
        ->setMargin(2)
        ->setOutfile($path)
        ->png();
    
        $qrImage =  file_get_contents($path);
    
        Storage::disk('s3')->put('qrcode/' . $qrcode_name, $qrImage,['ACL' => 'public-read']);

        return ApiResponseClass::sendResponse(['url' => $url , 'image'=> $qrcode_image],'Successfully Generate Friend QRCode',200);
    }

    return ApiResponseClass::sendResponse(['url' => '' , 'image'=> $album->qrcode_image],'Already have QRCode',200);
   
});

Route::post('/generateQRCodeUrl',function(){
    //create a remote_id
    //format https://domain.com/photographer/remote/remote_id/ token + 16chars HASH of the string "SALT123+device_id"

    $filename = '/qr-code';
    $extention = '.png';
    $path = storage_path(). $filename . $extention;
    $qrcode_name =  Str::random(5) . $extention; 

    $venue = Venue::all()->random();

    $remote = Remote::create([
        'venue_id' => $venue->id,
        'qrcode_image' => 'https://photographer.s3.ap-southeast-1.amazonaws.com/qrcode/'. $qrcode_name
    ]);
    
    $url = 'http://localhost:5173/photographer/remote/' . $remote->id . '/' . hash('sha256','SALT123+'. $remote->id);
 
    QRCode::url($url)
    ->setSize(8)
    ->setMargin(2)
    ->setOutfile($path)
    ->png();

    $qrImage =  file_get_contents($path);

    Storage::disk('s3')->put('qrcode/' . $qrcode_name, $qrImage,['ACL' => 'public-read']);


    return ApiResponseClass::sendResponse(['remote' => $remote, 'url' => $url],'Successfully Generate QRCode',200);
});




Route::post('/scan',function(Request $request){
   //get the remote - device_id
   //check if remote-device is already associated with the album status is 'live' 
   //create new album first 
   //create user
   //setup the cookies

   DB::beginTransaction();
   try {

    $remoteId = $request->query('remote_id');

    $remote = Remote::find($remoteId);
 
    if(!$remote){
         return ApiResponseClass::sendResponse([''=> ''],'Remote device not found!',404);
    }
 
    $album = Album::where('remote_id',$remote->id)->where('status','live')->first();
 
    if($album){
     return ApiResponseClass::sendResponse([''=> ''],'This remote is already in use',400);
    }
 
    $newAlbum = Album::create([
     'remote_id' => $remote->id,
     'status' => 'live',
     'date_add' => now(),
     'venue_id' => $remote->venue_id
    ]);
 
    $user = User::create([
     'album_id' => $newAlbum->id,
     'name' => 'scanned_' . $remote->id,
     'email' => 'scanned_email' . Str::random(5) . '@gmail.com' ,
     'password' => 'scanned_password'
    ]);
    
    $token = hash('sha256', 'SALT123+' . $user->id . '+' . $newAlbum->id);
    
    DB::commit();

    return ApiResponseClass::sendResponseWithCookie(['user' => $user, 'new_album' => $newAlbum , 'url' => [
        'user_id' => $user->id,
        'album_id' => $newAlbum->id,
        'token' => $token
    ]] ,'Successfully Create User' , 200 , $token);

   }
   catch (Exception $e){
     return ApiResponseClass::rollback($e);
   }
   
});
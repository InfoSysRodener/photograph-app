<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use App\Mail\Album;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DB;

class UserController extends Controller
{

    private UserRepositoryInterface $user; 

    public function __construct(UserRepositoryInterface $userRepositoryInterface){
        $this->user = $userRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->user->index();

        return ApiResponseClass::sendResponse(UserResource::collection($data), '',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        DB::beginTransaction();
        try{
            $details =[
                'email' => $request->email,
                'email_verified_at' => now()
            ];
    
            if($user->email_verified_at === null){
                //send mail
                Mail::to($request->email)->send(new Album($user));
            }
            
            $this->user->update($details,$user->id);
    
            return ApiResponseClass::sendResponse('', 'Successfully Updated',200);
        }catch(\Exception $e){
            return ApiResponseClass::rollback($e);
        }
       
    }

    public function notifyAllAlbumUsers(User $user){

      $users = User::where('album_id',2)->get();
      dd($users);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

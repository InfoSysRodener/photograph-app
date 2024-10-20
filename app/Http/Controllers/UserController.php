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
use Str;

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
        DB::beginTransaction();
        
        try {

            $details = [
                'email' => $request->email,
                'album_id' => $request->album_id,
                'name' => 'name_' . Str::random(5) 
            ];

            $data = $this->user->store($details);

            DB::commit();
                
            return ApiResponseClass::sendResponse($data, 'Successfully Created',200);

        }catch(\Exception $e){
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $data = $this->user->getById($id);
        return ApiResponseClass::sendResponse(new UserResource($data), '',200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      
        DB::beginTransaction();
        try{
            $details =[
                'email' => $request->email,
                'email_verified_at' => now()
            ];

            $user = $this->user->getById($id);

            if($user->email_verified_at === null){
                //send mail
                Mail::to($request->email)->send(new Album($user));
            }
            
            $this->user->update($details,$id);

            DB::commit();
           
    
            return ApiResponseClass::sendResponse('', 'Successfully Updated',200);
        }catch(\Exception $e){
            return ApiResponseClass::rollback($e);
        }
       
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

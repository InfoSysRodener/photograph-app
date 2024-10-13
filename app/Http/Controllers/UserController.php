<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

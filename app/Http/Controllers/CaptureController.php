<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Interfaces\CaptureRepositoryInterface;
use App\Models\Capture;
use Cookie;
use Illuminate\Http\Request;

class CaptureController extends Controller
{
    
    private CaptureRepositoryInterface $capture;

    public function __construct(CaptureRepositoryInterface $captureRepositoryInterface){
        $this->capture = $captureRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {  
        $album_id = $request->query('album_id');
        //check the user or hash

        $data = $album_id ? $this->capture->getByAlbumId($album_id) : $this->capture->index();
        
        return ApiResponseClass::sendResponse($data, '',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = $this->capture->getById($id);
        
        return ApiResponseClass::sendResponse($data, '',200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Capture $capture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Capture $capture)
    {
        //
    }
}

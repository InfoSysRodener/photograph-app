<?php

namespace App\Http\Controllers;

use App\Http\Resources\AlbumResource;
use App\Interfaces\AlbumRepositoryInterface;
use App\Models\Album;
use Illuminate\Http\Request;
use App\Classes\ApiResponseClass;
use DB;

class AlbumController extends Controller
{

    private AlbumRepositoryInterface $album;

    public function __construct(AlbumRepositoryInterface $albumRepositoryInterface)
    {
        $this->album = $albumRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->album->index();

        return ApiResponseClass::sendResponse(AlbumResource::collection($data), '',200);
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
        $data = $this->album->getById($id);

        return ApiResponseClass::sendResponse(new AlbumResource($data),'',200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        DB::beginTransaction();
        try{
            $details =[
                'status' => $request->get('album_status'),
                'date_update' => now()
            ];

            $this->album->update($details,$id);

            DB::commit();
           
    
            return ApiResponseClass::sendResponse('', 'Successfully Updated',200);
        }catch(\Exception $e){
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //
    }
}

<?php

namespace App\Repositories;

use App\Interfaces\CaptureRepositoryInterface;
use App\Models\Capture;

class CaptureRepository implements CaptureRepositoryInterface
{
    public function index(){
        return Capture::latest()->simplePaginate(10);
    }

    public function getByAlbumId($albumId){
        return Capture::whereHas('album', fn($query) => 
            $query->where('album_id', $albumId)
        )->latest()->simplePaginate(10);
    }

    public function getById($id){
        return Capture::latest()->find($id);
    }

}

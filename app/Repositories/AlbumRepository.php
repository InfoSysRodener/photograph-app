<?php

namespace App\Repositories;
use App\Interfaces\AlbumRepositoryInterface;
use App\Models\Album;

class AlbumRepository implements AlbumRepositoryInterface
{
    
    public function index(){
        return Album::all();
    }

    public function getById($id) {
        return Album::with(['capture','remote'])->find($id);
    }

    public function store(array $data){
        return Album::create($data);
     }
 
     public function update(array $data,$id){
        return Album::whereId($id)->update($data);
     }
     
     public function delete($id){
        Album::destroy($id);
     }
}

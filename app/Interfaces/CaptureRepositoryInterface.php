<?php

namespace App\Interfaces;

interface CaptureRepositoryInterface
{
    //
    public function index();

    public function getById($id);

    public function getByAlbumId($albumId);
}

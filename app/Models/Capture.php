<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capture extends Model
{
    /** @use HasFactory<\Database\Factories\CaptureFactory> */
    use HasFactory;

    public function album(){
        return $this->belongsTo(Album::class);
    }

}

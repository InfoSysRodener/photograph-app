<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remote extends Model
{
    /** @use HasFactory<\Database\Factories\RemoteFactory> */
    use HasFactory;

    protected $fillable = [ 
        'venue_id',
        'qrcode_image'
    ];


}

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

    public function album() {
        return $this->has(Album::class);
    }
}

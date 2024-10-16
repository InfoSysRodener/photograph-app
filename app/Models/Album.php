<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['remote_id','status','date_add','venue_id','qrcode_image'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function capture(){
        return $this->hasMany(Capture::class);
    }

    public function remote(){
        return $this->belongsTo(Remote::class);
    }

   
}

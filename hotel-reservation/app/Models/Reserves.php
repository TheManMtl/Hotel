<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserves extends Model
{
    use HasFactory;

    protected $tablename = [
        'reserves'    
    ];

    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }
}

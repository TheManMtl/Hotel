<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $tablename = [
        'rooms',
    ];

    public function reserves()
    {
        return $this->hasMany(Reserves::class, 'room');
    }
}

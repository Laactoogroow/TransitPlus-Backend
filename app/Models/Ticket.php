<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_name',
        'origin',
        'destination',
        'departure_time',
        'price',
    ];

    // public function destination()
    // {
    //     return $this->belongsTo(Destination::class, 'destination_name', 'name');
    // }
}

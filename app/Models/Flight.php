<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_no',
        'schedule',
        'status',
        'destinasi',
        'logo',
    ];


    // public function airline()
    // {
    //     return $this->belongsTo(Airline::class);
    // }
}

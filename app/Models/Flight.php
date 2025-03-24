<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline_id',
        'flight_no',
        'schedule',
        'logo',
        'destinasi',
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }
}

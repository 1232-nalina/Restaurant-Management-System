<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Table extends Model
{
    use HasFactory;
    protected $table = 'tables';
    protected $fillable = [
        'name',
        'status',
        'seats',
    ];

    // public function reservations()
    // {
    //     return $this->hasMany(Reservation::class);
    // }
}

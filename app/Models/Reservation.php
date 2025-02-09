<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'reservations';
    protected $fillable = [
     'name',
     'email',
     'phone',
     'date',
     'time',
     'person',
    ];
}


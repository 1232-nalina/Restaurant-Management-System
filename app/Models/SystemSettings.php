<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSettings extends Model
{
    use HasFactory;
    protected $table='system_settings';
    protected $fillable=[
        'name',
        'address',
        'logo',
        'signature',
        'pan',
        'email',
        'phone',
        'status'
    ];
}

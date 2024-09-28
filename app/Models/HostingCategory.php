<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostingCategory extends Model
{
    use HasFactory;
    protected $table='hosting_categories';
    protected $fillable=[
        'name',
        'provider',
        'price',
        'status'
    ];
}

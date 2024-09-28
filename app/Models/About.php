<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $table='abouts';
    protected $fillable=[
        'title',
        'meta_keyword',
        'meta_description',
        'description',
        'mission',
        'vision',
        'values',
        'image',
        'banner_image',
        'status'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;

class Sections extends Model
{
    use HasFactory;
    protected $table = 'sections';
    protected $fillable = [
        'name',
    ];
    public function createUniqueSectionId()
    {
        return uniqid('CLX');
    }

    public function classes()
{
    return $this->belongsToMany(Classes::class, 'class_section');
}
}

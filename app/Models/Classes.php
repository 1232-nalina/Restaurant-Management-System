<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sections;
use Illuminate\Support\Str;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes';
    protected $fillable = ['name'];

    /*
     * Return unique Id
     * */
    public function createUniqueClassId(){
        return uniqid('CLX');
    }
    public function sections()
    {
        return $this->belongsToMany(Sections::class, 'class_section');
    }
}

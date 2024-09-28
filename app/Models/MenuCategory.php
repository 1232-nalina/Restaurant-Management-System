<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;
    protected $table='menu_categories';
    protected $fillable = [
        'name',
        'type',
    ];

    public function MenuItem()
    {
        // return $this->hasMany(MenuItem::class);
        return $this->hasMany(MenuItem::class, 'menu_cat_id', 'id');
    }
}

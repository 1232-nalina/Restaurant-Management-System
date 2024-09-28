<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    protected $table='menu_items';
    protected $fillable=[
        'menu_cat_id',
        'name',
        'price',
        'image',
        'status',
        'description'
    ];
    public function menucategory()
    {
        return $this->belongsTo(MenuCategory::class, 'menu_cat_id', 'id');
    }
}

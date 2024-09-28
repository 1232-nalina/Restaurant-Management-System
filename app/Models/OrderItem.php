<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MenuItem;

class OrderItem extends Model
{
    use HasFactory;
    protected $table='order_items';
    protected $fillable=[
        'order_id',
        'menu_item_id',
        'quantity',
        'price',
        'kitchen_id',

    ];
    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }
    public function kitchen()
    {
        return $this->belongsTo(kitchen::class, 'kitchen_id');
    }
}

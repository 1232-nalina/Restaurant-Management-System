<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Table;
use App\Models\OrderItem;
use App\Models\MenuItem;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable = [
        'table_id',
        'status',
        'total',
    ];
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
   
}

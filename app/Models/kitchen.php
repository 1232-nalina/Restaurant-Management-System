<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kitchen extends Model
{
    use HasFactory;
    protected $table = 'kitchen';
    protected $fillable = ['name'];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

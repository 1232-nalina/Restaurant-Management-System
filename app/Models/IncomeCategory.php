<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    use HasFactory;
    protected $table = 'income_categories';
    protected $fillable = [
        'category_name',
        'status',
        'admin_id',
        'income_amount',
    ];
}

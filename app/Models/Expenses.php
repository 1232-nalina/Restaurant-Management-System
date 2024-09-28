<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $table = 'expenses';
    protected $fillable = [
        'category_id',
        'user_id',
        'expenses_date',
        'amount',
        'status',

    ];
    public function expenses_cat()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id', 'id');
    }
}

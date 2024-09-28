<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;
    protected $table = 'domains';
    protected $fillable = [
        'name',
        'issuer',
        'issue_date',
        'expiry_date',
        'cost_price',
        'selling_price',
        'client_id',
        'status',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}

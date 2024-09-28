<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hosting extends Model
{
    use HasFactory;
    protected $table = 'hostings';
    protected $fillable = [
        'hosting_cat_id',
        'domain_id',
        'external_domain',
        'issue_date',
        'expiry_date',
        'client_id',
        'selling_price',
        'status'
    ];
    public function hosting_cat()
    {
        return $this->belongsTo(HostingCategory::class, 'hosting_cat_id', 'id');
    }
    public function domain()
    {
        return $this->belongsTo(Domain::class, 'domain_id', 'id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}

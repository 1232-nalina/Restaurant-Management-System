<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $fillable = ['address','email','phone_one','phone_two','logo','fab_icon','banner_image','google_map','facebook_link','twitter_link','instagram_link','gmail_link'];
}

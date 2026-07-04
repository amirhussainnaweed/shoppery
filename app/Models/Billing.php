<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Billing extends Model
{
      use HasFactory;
    protected $fillable = [
        'user_id',
        'address_id'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Address(){
        return $this->belongsTo(Address::class);
    }


}

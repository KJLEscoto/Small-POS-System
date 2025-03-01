<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];

    public function customers(){
        return $this->belongsTo(Customer::class);
    }

    public function products(){
        return $this->hasMany(Order_Item::class);
    }
}
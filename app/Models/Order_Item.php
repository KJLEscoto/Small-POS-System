<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    protected $table = 'order_items';
    protected $guarded = [];

    public function orders(){
        return $this->belongsTo(Sale::class);
    }

    public function products(){
        return $this->belongsTo(Product::class);
    }
}
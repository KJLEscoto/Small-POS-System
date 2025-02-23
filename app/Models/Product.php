<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $table = 'products';

    use SoftDeletes; // Enable soft deletes

    protected $fillable = [
        'name',
        'image',
        'category_id',
        'stock',
        'original_price',
        'selling_price'
    ];

    protected $dates = ['deleted_at']; // Add deleted_at column

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
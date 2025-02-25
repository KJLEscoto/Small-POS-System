<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    /** @use HasFactory<\Database\Factories\CashierFactory> */
    use HasFactory;

    protected $table = 'users';

    protected $guarded = [];

}
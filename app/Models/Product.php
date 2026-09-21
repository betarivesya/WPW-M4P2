<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. Import HasFactory
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // 2. Tambahkan trait ini di sini

    protected $fillable = ['category_id', 'name', 'sku', 'price', 'stock'];
}

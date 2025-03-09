<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_code',
        'product_name',
        'product_category',
        'brand',
        'model',
        'first_stocks',
        'latest_stock',
        'buying_price',
        'selling_price',
        'unit_type',
        'in_date',
        'expired_date',
        'description',
        'shelf_location',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
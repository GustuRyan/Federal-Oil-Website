<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * Atribut-atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array
     */
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

    /**
     * Atribut yang disembunyikan saat serialisasi.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
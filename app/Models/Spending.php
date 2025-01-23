<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spending extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'spends';

    /**
     * Atribut-atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'spending_type',
        'distributor',
        'total_cost',
        'payment_methods',
        'description',
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
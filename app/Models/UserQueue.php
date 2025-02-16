<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQueue extends Model
{
    use HasFactory;
    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'user_queue';

    /**
     * Atribut-atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'queue',
        'customer_id',
        'issue',
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

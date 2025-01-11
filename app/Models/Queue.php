<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    /**
     * 
     *
     * @var string
     */
    protected $table = 'queue';

    /**
     * 
     *
     * @var array
     */
    protected $fillable = [
        'current_queue',
        'queue_list',
    ];

    /**
     * 
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * 
     *
     * @var array
     */
    protected $casts = [
        'queue_list' => 'array',
    ];
}
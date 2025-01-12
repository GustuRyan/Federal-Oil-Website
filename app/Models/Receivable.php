<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receivable extends Model
{
    use HasFactory;

    /**
     * 
     *
     * @var string
     */
    protected $table = 'receivable';

    /**
     * 
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'total_cost',
        'due_date',
        'payment_status',
        'description',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
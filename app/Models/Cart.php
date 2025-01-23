<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'carts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'amount',
        'service_id',
        'service_time',
    ];

    /**
     * Get the product associated with the cart.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the service associated with the cart.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
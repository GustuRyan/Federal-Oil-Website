<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_code',
        'service_name',
        'service_price',
        'description',
    ];

    /**
     * Get the carts associated with the service.
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}

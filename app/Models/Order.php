<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Order extends Model
{
    use HasFactory;
    use HasUlids;
    use SoftDeletes;

    protected $fillable = [
        'store_id',
        'qty_products',
        'total',
        'total_with_delivery',
        'store_name',
        'store_address',
        'code',
        'order_type',
        'order_date',
        'order_time',
        'open',
        'customer_address',
        'state'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, OrderProduct::class, 'order_id', 'product_id')->withPivot('qty', 'total');
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}

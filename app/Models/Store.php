<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Store extends Model
{
    use HasFactory;
    use HasUlids;
    use SoftDeletes;

    protected $fillable = [
        'logo',
        'background',

        'name',
        'address',

        'slug',

        'latitude',
        'longitude',

        'delivery',
        'take_out',
        'rating',

        'products_with_stock',
        'price_with_discount',
        'price_without_discount',

        'opening_hours',
        'kind_of_attention'
    ];

    public function schedules()
    {
        return $this->hasMany(StoreSchedule::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function product_categories()
    {
        return $this->hasMany(ProductCategory::class);
    }
}

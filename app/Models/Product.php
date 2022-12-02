<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Product extends Model
{
    use HasFactory;
    use HasUlids;
    use SoftDeletes;

    protected $fillable = [
        'store_id',

        'name',
        'image',

        'stock',

        'price_with_discount',
        'price_without_discount',

    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, ProductCategory::class, 'product_id', 'category_id');
    }

    public function product_categories()
    {
        return $this->hasMany(ProductCategory::class);
    }
}

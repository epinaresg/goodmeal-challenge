<?php

namespace App\Models;

use App\Observers\Api\Backoffice\StoreObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Store extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'logo',
        'name',
        'address',

        'slug',

        'delivery',
        'take_out',
        'rating'
    ];
}

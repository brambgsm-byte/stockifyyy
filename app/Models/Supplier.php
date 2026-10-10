<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
    ];

    /**
     * Satu supplier dapat memiliki banyak produk.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'supplier_id');
    }
}
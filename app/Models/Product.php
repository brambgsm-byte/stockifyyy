<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'supplier_id',
        'code',
        'name',
        'description',
        'unit',
        'size',
        'color',
        'purchase_price',
        'selling_price',
        'minimum_stock',
        'stock',
        'image',
    ];

    protected $casts = [
        'purchase_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'minimum_stock' => 'integer',
        'stock' => 'integer',
    ];

    /**
     * Relasi produk dengan kategori.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi produk dengan supplier.
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
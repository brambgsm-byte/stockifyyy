<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type',
        'quantity',
        'transaction_date',
        'description',
        'user_id',
        'status',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'quantity' => 'integer',
    ];

    /**
     * Transaksi ini terkait dengan produk.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Transaksi ini dilakukan oleh user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity',
        'description',
        'module',
        'ip_address',
    ];

    /**
     * Relasi ke user yang melakukan aktivitas.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
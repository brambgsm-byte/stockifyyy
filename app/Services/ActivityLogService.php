<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogService
{
    /**
     * Mencatat aktivitas pengguna.
     */
    public static function log(
        string $activity,
        ?string $description = null,
        ?string $module = null
    ): void {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => $activity,
            'description' => $description,
            'module' => $module,
            'ip_address' => Request::ip(),
        ]);
    }
}
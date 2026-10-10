<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    /**
     * Menampilkan riwayat aktivitas pengguna.
     */
    public function index(): View
    {
        $activities = ActivityLog::with('user')
            ->latest()
            ->paginate(15);

        return view('activity-logs.index', compact('activities'));
    }
}
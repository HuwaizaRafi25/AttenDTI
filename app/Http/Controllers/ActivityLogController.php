<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::orderBy('created_at', 'desc')->paginate(10);

        return view('menus.activity_log', compact('logs'));
    }

    public function search(Request $request)
    {
        $rafi_search = $request->get('q');

        $logs = ActivityLog::with('outlet')
            ->where(function ($query) use ($rafi_search) {
                $query->where('nama', 'like', "%{$rafi_search}%")
                    ->orWhere('email', 'like', "%{$rafi_search}%");
            })
            ->paginate(5);

        return view('menus.tables.activity_log_table', compact('logs'));
    }
}

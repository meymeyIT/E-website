<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemAlert;

class AlertController extends Controller
{
    /**
     * Display a listing of system alerts.
     */
    public function index()
    {
        // Get all alerts with user relation, latest first
        $alerts = SystemAlert::with('user')->orderBy('created_at', 'desc')->get();

        // Count unread alerts
        $systemAlertsCount = SystemAlert::where('is_read', false)->count();

        return view('admin.alerts.index', compact('alerts', 'systemAlertsCount'));
    }

    /**
     * Mark a specific alert as read.
     */
    public function markAsRead($id)
    {
        $alert = SystemAlert::findOrFail($id);
        $alert->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Alert marked as read.');
    }

    /**
     * Mark all alerts as read.
     */
    public function markAllAsRead()
    {
        SystemAlert::where('is_read', false)->update(['is_read' => true]);

        return redirect()->back()->with('success', 'All alerts marked as read.');
    }
}

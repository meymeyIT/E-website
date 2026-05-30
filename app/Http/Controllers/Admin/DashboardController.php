<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\SystemAlert;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $pendingOrders = Order::where('order_status', 'pending')->count();

        $monthlyRevenue = Order::whereMonth('created_at', Carbon::now()->month)
                               ->whereYear('created_at', Carbon::now()->year)
                               ->sum('total_price');

        // Count unread alerts
        $systemAlertsCount = SystemAlert::where('is_read', false)->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'pendingOrders',
            'monthlyRevenue',
            'systemAlertsCount'
        ));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function salesReport(Request $request)
    {
        // Optional date filter
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Order::query();

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        // Get total sales per day
        $salesData = $query->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as orders_count'),
                DB::raw('SUM(total_price) as total_sales')
            )
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->paginate(15);

        return view('admin.reports.sales', compact('salesData', 'startDate', 'endDate'));
    }
}

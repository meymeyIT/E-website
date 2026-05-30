<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(100);
        return view('admin.orders.index', compact('orders')); // ✅ FIXED
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|string|in:pending,processing,shipped,completed,canceled',
        ]);

        $order->order_status = $request->input('order_status');
        $order->save();

        return redirect()->back()->with('status', 'Order status updated successfully.');
    }

    /**
     * Disable creation, editing, and deletion of orders from admin.
     */
    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function edit(Order $order)
    {
        abort(404);
    }

    public function destroy(Order $order)
    {
        abort(404);
    }
}

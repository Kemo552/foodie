<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{

    public function index(Request $request, $status = null)
    {
        $order_id = null;
        if ($request->has('order_id')) {
            $order_id = $request->order_id;
        }

        if ($status == null)
            $orders = Order::all();
        else
            $orders = Order::where('status', $status)->get();

        return view('dashboard.orders')
            ->with('orders', $orders)
            ->with('order_id', $order_id)
            ->with('page', 'Orders');
    }

    public function update_status($order_id, Request $request)
    {
        $request->validate(['status' => 'required']);
        $order = Order::findOrFail($order_id);
        $order->status = $request->status;
        $order->update();
        return redirect()
            ->route('order.status')
            ->with('msg', 'Order status has been updated successfully!')
            ->with('msg_cls', 'success');
    }
}
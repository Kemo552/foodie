<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $categories = Category::count();
        $products = Product::count();
        $orders = Order::count();
        $delivered_items = Order::where('status', 'delivered')->count();
        $pending_items = Order::where('status', 'pending')->count();
        $paid_items = Order::where('status', 'paid')->count();
        $users = User::count();
        $amount = Order::sum('total_price');
        return view('dashboard.dashboard')
            ->with('admin', auth()->user()->username)
            ->with('categories', $categories)
            ->with('products', $products)
            ->with('orders', $orders)
            ->with('delivered_items', $delivered_items)
            ->with('pending_items', $pending_items)
            ->with('paid_items', $paid_items)
            ->with('users', $users)
            ->with('amount', $amount)
            ->with('page', 'Dashboard');
    }
}
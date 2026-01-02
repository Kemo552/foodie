<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.phone',
                DB::raw('COUNT(orders.id) as orders'),
                DB::raw('SUM(orders.total_price) as total_cost')
            )
            ->groupBy('users.id', 'users.name', 'users.email', 'users.phone')
            ->get();
        return view('dashboard.reports')
            ->with('page', 'Reports')
            ->with('reports', $reports);
    }
}
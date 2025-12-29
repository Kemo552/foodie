<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function invoice($payment_id)
    {
        $items = Order::with('product')
            ->where('user_id', auth()->id())
            ->where('payment_id', $payment_id)
            ->get();
        return view('user.invoice')
            ->with('class', $this->class)
            ->with('items', $items)
            ->with('payment_id', $payment_id);
    }

    public function download_invoice($payment_id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

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
        if (!$items->isEmpty()) {
            return view('user.invoice')
                ->with('class', $this->class)
                ->with('items', $items)
                ->with('payment_id', $payment_id);
        } else {
            return redirect()
                ->back()
                ->with('msg', 'Your request is forbidden!')
                ->with('msg_cls', 'warning');
        }
    }

    public function download_invoice($payment_id)
    {
        $items = Order::where('payment_id', $payment_id)->get();
        $total_cost = Order::where('payment_id', $payment_id)->sum('total_price');
        $issued_on = Order::where('payment_id', $payment_id)->first()->value('created_at');

        $pdf = Pdf::loadView('user.invoice-download', compact('items', 'total_cost', 'issued_on'))
            ->setOptions([
                'isRemoteEnabled' => true,
            ]);

        return $pdf->download("invoice-" . $payment_id . '.' . now() . ".pdf");
    }
}
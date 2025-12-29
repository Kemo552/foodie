<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralUtils;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public $class = 'sub_page';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $current_year = (int) now()->year;
        $last_range_year = $current_year + 5;
        return view('user.payment')
            ->with('class', $this->class)
            ->with('last', $last_range_year)
            ->with('year', $current_year);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if ($request->filled('cod_address')) {
                $request->validate([
                    'cod_address' => 'required',
                ]);
                $address = $request->input('cod_address');
                $payment_id = $this->pay_order($address);
            } else {
                $request->validate([
                    'name' => 'required|string',
                    'card_no' => 'required|string|size:16',
                    'cvv' => 'required|numeric',
                    'month' => 'required',
                    'year' => 'required',
                    'delivery_address' => 'required'
                ]);
                $address = $request->input('delivery_address');
                $name = $request->input('name');
                $card_no = "************" . Str::substr($request->input('card_no'), 12, 4);
                $expiry_date = $request->input('month') . '-' . $request->input('year');
                $cvv = $request->input('cvv');
                $payment_id = $this->pay_order($address, $name, $card_no, $expiry_date, $cvv, 'card');
            }
            return redirect()
                ->route('invoice', ['payment_id' => $payment_id])
                ->with('msg', "Payment has been perfumed successfully!")
                ->with('msg_cls', 'success');
        } catch (Exception $ex) {
            return redirect()
                ->route('cart.index')
                ->with('msg', $ex->getMessage())
                ->with('msg_cls', 'danger');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function pay_order($address, $name = null, $card_no = null, $expiry_date = null, $cvv = null, $payment_mode = 'cod')
    {
        try {
            DB::beginTransaction();

            // insert into payments table
            $payment = Payment::create([
                'name' => $name,
                'card_no' => $card_no,
                'expiry_date' => $expiry_date,
                'cvv' => $cvv,
                'address' => $address,
                'payment_mode' => $payment_mode
            ]);

            $items = Cart::with('product')->where('user_id', auth()->id())->get();
            foreach ($items as $item) {
                // update product quantity in store
                $this->update_quantity($item->product_id, $item->quantity);

                // remove current item from cart
                $this->update_cart($item->id);

                // generate unique id
                $order_no = GeneralUtils::uuid();

                // insert data into orders table
                Order::create([
                    'order_no' => $order_no,
                    'product_id' => $item->product_id,
                    'user_id' => $item->user_id,
                    'payment_id' => $payment->id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->product->price,
                    'total_price' => ($item->product->price * $item->quantity),
                    'status' => 'paid',
                ]);
            }
            DB::commit();
            return $payment->id;
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    private function update_quantity($product_id, $quantity)
    {
        $product_qty = DB::table('products')->where('id', $product_id)->value('quantity');
        $remain = $product_qty - $quantity;
        DB::statement("UPDATE products SET quantity = $remain WHERE id = $product_id");
    }

    public function update_cart($item_id)
    {
        $item = Cart::findOrFail($item_id);
        $item->delete();
    }
}

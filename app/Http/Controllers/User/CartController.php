<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralUtils;
use App\Models\Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public $class = 'sub_page';

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $edit = null;
        if ($request->has('edit')) {
            $edit = $request->get('edit');
        }
        $grand_total = 0;
        $items = DB::table('carts')->select([
            'carts.id',
            'products.name',
            'products.price',
            'products.imageUrl',
            'products.quantity',
            'carts.quantity',
            'carts.product_id'
        ])
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->where('carts.user_id', auth()->id())
            ->get();

        if ($items != null) {
            foreach ($items as $item) {
                $grand_total += ($item->price * $item->quantity);
            }
        }

        return view('user.cart', ['edit' => $edit])
            ->with('class', $this->class)
            ->with('items', $items)
            ->with('grand_total', $grand_total);
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
        if (Cart::where('product_id', $request->product_id)->exists()) {
            $item = Cart::where('product_id', $request->product_id)->where('user_id', auth()->id())->first();

            // check for availability in store
            [$quantity, $msg, $msg_cls] = GeneralUtils::check_for_product_quantity_in_store($request->product_id, $item->quantity + 1);

            // update quantity
            $item['quantity'] = $quantity;
            $item->update();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => 1
            ]);
            $msg = 'Item has been added to your cart successfully.';
            $msg_cls = 'success';
        }
        return redirect()
            ->route('cart.index')
            ->with('msg', $msg)
            ->with('msg_cls', $msg_cls);
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
        try {
            $product_id = DB::table('carts')->where('id', $id)->value('product_id');
            // check for availability in store
            [$updated, $msg, $msg_cls] = GeneralUtils::check_for_product_quantity_in_store($product_id, $request->quantity);

            // update quantity
            $item = Cart::findOrFail($id);
            $item->quantity = $updated;
            $item->updated_at = now();
            $item->update();

            return redirect()
                ->route('cart.index')
                ->with('msg', $msg)
                ->with('msg_cls', $msg_cls);
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->with('msg', $ex->getMessage())
                ->with('msg_cls', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $item = Cart::findOrFail($id);
            $item->delete();
            return redirect()
                ->back()
                ->with('msg', 'Item has been deleted successfully.')
                ->with('msg_cls', 'success');
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->with('msg', $ex->getMessage())
                ->with('msg_cls', 'danger');
        }
    }
}

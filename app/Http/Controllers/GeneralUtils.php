<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GeneralUtils extends Controller
{
    public static function check_for_product_quantity_in_store($product_id, $quantity)
    {
        $product_qty = DB::table('products')->where('id', $product_id)->value('quantity');

        if ($quantity <= $product_qty) {
            $msg = 'Item quantity has been updated successfully!';
            $msg_cls = 'success';
            return [$quantity, $msg, $msg_cls];
        } else if ($quantity > $product_qty) {
            $msg = 'Desired quantity is not available right now, we have updated your quantity with the largest amount for now!';
            $msg_cls = 'info';
            return [$product_qty, $msg, $msg_cls];
        }
    }

    public static function uuid()
    {
        $uuid = (string) Str::uuid();
        return $uuid;
    }
}

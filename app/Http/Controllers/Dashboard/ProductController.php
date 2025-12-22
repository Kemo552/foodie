<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $product = null;
        $cmd_name = 'Add';
        if ($request->has('edit')) {
            $product = Product::findOrFail($request->edit);
            $cmd_name = 'Update';
        }
        $products = Product::all();
        foreach ($products as $prod) {
            $prod['category_name'] = $prod->category->name;
        }
        return view('dashboard.products', [
            'products' => $products,
            'categories' => Category::all(),
            'product' => $product,
            'cmd_name' => $cmd_name,
            'page' => 'Products'
        ]);
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
            $request->validate([
                'name' => 'required|string',
                'description' => 'nullable',
                'price' => 'required|numeric',
                'quantity' => 'required|integer',
                'category_id' => 'required|integer',
                'imageUrl' => 'image|mimes:png,jpg,jpeg',
            ]);

            if ($request->hasFile('imageUrl')) {
                $file = $request->imageUrl;
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $request->imageUrl->move('images\product', $file_name);
            } else {
                $file_name = 'no_image.png';
            }

            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'category_id' => $request->category_id,
                'imageUrl' => $file_name,
                'active' => $request->active,
            ]);

            return redirect()->route('product.index')
                ->with('msg', "Product has been added successfully")
                ->with('msg_cls', "success");
        } catch (Exception $ex) {
            return redirect()->back()
                ->with('msg', $ex->getMessage())
                ->with('msg_cls', "warning");
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
        try {
            $product = Product::findOrFail($id);
            if ($request->hasFile('imageUrl')) {
                $file = $request->imageUrl;
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $request->imageUrl->move('images\product', $file_name);
            } else if ($product->imageUrl != null) {
                $file_name = $product->imageUrl;
            } else {
                $file_name = 'no_image.png';
            }

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->category_id = $request->category_id;
            $product->imageUrl = $file_name;
            $product->active = $request->active;
            $product->updated_at = now();
            $product->update();

            return redirect()
                ->route('product.index')
                ->with('msg', 'Product has been edited successfully.')
                ->with('msg_cls', 'success');
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
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()
                ->back()
                ->with('msg', 'Product has been deleted successfully.')
                ->with('msg_cls', 'success');
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->with('msg', $ex->getMessage())
                ->with('msg_cls', 'danger');
        }
    }
}
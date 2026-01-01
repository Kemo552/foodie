<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $class = 'sub_page';
    public function about_us()
    {
        return view('user.about')->with('class', $this->class);
    }

    public function home()
    {
        return view('user.home')->with('class', null);
    }

    public function menu()
    {
        $products = Product::all(); //where('active', 1);
        $categories = Category::all();
        return view('user.menu')->with('class', $this->class)->with('products', $products)->with('categories', $categories);
    }

    public function book_table()
    {
        return view('user.book-table')->with('class', $this->class);

    }

}
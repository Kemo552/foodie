<?php

namespace App\Http\Controllers\Dashoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = null;
        $cmd_name = 'Add';
        if ($request->has('edit')) {
            $category = Category::findOrFail($request->edit);
            $cmd_name = 'Update';
        }
        $categories = Category::all();
        return view('dashboard.categories', [
            'categories' => $categories,
            'category' => $category,
            'cmd_name' => $cmd_name,
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
            if ($request->hasFile('imageUrl')) {
                $file = $request->imageUrl;
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $request->imageUrl->move('images\category', $file_name);
            } else {
                $file_name = 'no_image.png';
            }

            Category::create([
                'name' => $request->name,
                'imageUrl' => "images/category/" . $file_name,
                'active' => $request->active,
            ]);

            return redirect()->route('category.index')
                ->with('msg', "Category has been added successfully")
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
            if ($request->hasFile('imageUrl')) {
                $file = $request->imageUrl;
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $request->imageUrl->move('images\category', $file_name);
            } else {
                $file_name = 'no_image.png';
            }

            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->imageUrl = "images/category/" . $file_name;
            $category->active = $request->active;
            $category->updated_at = now();
            $category->update();

            return redirect()
                ->route('category.index')
                ->with('msg', 'Category has been edited successfully.')
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
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()
                ->back()
                ->with('msg', 'Category has been deleted successfully.')
                ->with('msg_cls', 'success');
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->with('msg', $ex->getMessage())
                ->with('msg_cls', 'danger');
        }
    }
}

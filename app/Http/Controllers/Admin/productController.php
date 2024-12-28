<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;


class productController extends Controller
{
    public function index() {
        $categories = category::all(); // Retrieves all categories
        $products = product::select()->get(); // Eager load categories for products
        return view('admin.products.index', compact('categories', 'products'));
    }

    public function create(Request $request){
        product::create($request->except(["_token"]));
        return redirect()->back()->with(['success' => 'Save has been success']);
    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){

    }
}

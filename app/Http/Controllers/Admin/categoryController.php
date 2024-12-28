<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;

class categoryController extends Controller
{
    public function index(){
        return view('admin.category.index');
    }

    public function create(Request $request){
        category::create($request->except("_token"));
        return redirect()->back()->with(['success' => 'Save has been success']);
    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){

    }
}

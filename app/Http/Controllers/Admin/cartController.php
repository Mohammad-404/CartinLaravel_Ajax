<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Session;


class cartController extends Controller
{

    public function addToCart(Request $request,$id){ //this function to add and update cart

        $product = product::find($id);

        if ($product) {
            $cart = Session::get('cart',[]);
            if (isset($cart[$id])) {    
                $cart[$id]["qty"] = $request->qty;   
                Session::put('cart', $cart);         
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product quantity updated!',
                    'cart' => $cart
                ]);
                // return redirect()->back()->with(['error_add' => 'item already exist']);    
            }else{
                $cart[$id] = [
                    "id"            => $product->id,
                    "name"          => $product->name,
                    "details"       => $product->details,
                    "qty"           => $request->qty,
                    "category"      => $product->category->name,
                ];
            }

            Session::put('cart',$cart);
            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart!',
                'cart' => $cart
            ]);
            // return redirect()->back()->with('success', 'Product added to cart!');
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Product not found.'
        ]);
            // return back()->with('error', 'Product not found.');
    }
  

    public function viewCart()
    {
        $cart = Session::get('cart', []);
        return response()->json(['cart' => $cart]);
    }
    

}

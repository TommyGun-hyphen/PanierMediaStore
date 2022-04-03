<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Models\Product;

class CartController extends Controller
{
    public function store(Request $request){
        $product = Product::findOrFail($request->input('product_id'));
        $quantity = 1;
        if($request->has('quantity') && is_numeric($request->input('quantity')) && $request->input('quantity') > 0){
            $quantity = $request->input('quantity');
        }
        if($request->session()->has('cart_products.'.$product->id)){
            $request->session()->put('cart_products.'.$product->id,$quantity+$request->session()->get('cart_products.'.$product->id));
        }else{
            $request->session()->put('cart_products.'.$product->id,$quantity);
        }

        return response()->json(['status'=>'success']);
    }

    public function index(Request $request){
        //dd(session()->get('cart_products'));
        $products = Collection::make();
        $cart_products = session()->get('cart_products');
        if($request->session()->has('cart_products')){
            $ids = array_keys($cart_products);
            $products = Product::whereIn('id', $ids)->get();
        }
        foreach($products as $product){
            $product->quantity = $cart_products[$product->id];
        }
        $subtotal = array_reduce($products->toArray(), function($carry, $curr){
            return $carry + ($curr['price'] * $curr['quantity']);
        }, 0);
        return view('cart', compact('products','subtotal'));
    }

    public function update(Request $request){
        for($i = 0; $i < count($request->input('quantity')); $i++){
            $request->session()->put('cart_products.'.$request->input('product_id')[$i],$request->input('quantity')[$i]);
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $product_id){
        $quantity = $request->session()->get('cart_products.'.$product_id);
        $request->session()->forget('cart_products.'.$product_id);
        $request->session()->put('last_item_deleted', [$product_id, $quantity]);
        return response()->json(['msg'=>'success']);
    }

    public function undo(Request $request){
        $request->session()->put('cart_products.'.$request->session()->get('last_item_deleted')[0], $request->session()->get('last_item_deleted')[1]);
        return redirect()->back();
    }
}

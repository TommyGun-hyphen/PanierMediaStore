<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Models\Product;
use App\Models\Extra;

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
        if($request->has('extras')){
            $extras;
            parse_str(request()->get('extras'), $extras);
            foreach($extras as $extra){
                if($extra == null)continue ;
                $request->session()->push('cart_extras.'.$product->id,$extra);
            }
        }
        return response()->json(['status'=>'success']);
    }

    public function index(Request $request){
        $extras = $request->session()->get('cart_extras');
        $products = Collection::make();
        $cart_products = session()->get('cart_products');
        if($request->session()->has('cart_products')){
            $ids = array_keys($cart_products);
            $products = Product::whereIn('id', $ids)->get();
        }
        foreach($products as $product){
            $product->quantity = $cart_products[$product->id];
            $cart_extras = Collection::make();
            if(isset($extras[$product->id])){
                $cart_extras = Extra::whereIn('id', $extras[$product->id][0])->get();
            }
            $product->cart_extras = $cart_extras;
            $product->total = array_reduce($cart_extras->toArray(), function($carry, $curr){
                return $carry + $curr['price'];
            },0) + $product->price;
        }
        $subtotal = array_reduce($products->toArray(), function($carry, $curr){
            return $carry + ($curr['total'] * $curr['quantity']);
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
        $extras = $request->session()->get('cart_extras.'.$product_id);
        $request->session()->forget('cart_products.'.$product_id);
        $request->session()->forget('cart_extras.'.$product_id);
        $request->session()->put('last_item_deleted', [$product_id, $quantity, $extras]);
        return response()->json(['msg'=>'success']);
    }

    public function undo(Request $request){
        $request->session()->put('cart_products.'.$request->session()->get('last_item_deleted')[0], $request->session()->get('last_item_deleted')[1]);
        $request->session()->put('cart_extras.'.$request->session()->get('last_item_deleted')[0], $request->session()->get('last_item_deleted')[2]);
        return redirect()->back();
    }
}

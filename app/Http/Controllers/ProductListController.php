<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductList;
use App\Models\Product;
class ProductListController extends Controller
{
    public function index(){
        $lists = ProductList::all();
        return view('list.index', compact('lists'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        if(ProductList::where('name', $request->input('name')->first())){
            return redirect()->back()->with('error', 'une liste existe deja avec ce nom!');
        }
        ProductList::create($request->all());
        return redirect()->back();
    }
    public function show($list_id){
        $list = ProductList::findOrFail($list_id);
        return view('list.show', compact('list'));
    }
    public function storeProduct(Request $request, $list_id){
        $request->validate([
            'slug' => 'required'
        ]);
        $product = Product::where('slug', $request->input('slug'))->firstOrFail();
        ProductList::findOrFail($list_id)->products()->attach($product->id);
        return redirect()->back();
    }
    public function destroyProduct($list_id, $product_id){
        ProductList::findOrFail($list_id)->products()->detach($product_id);
        return redirect()->back();
    }
    public function destroy($list_id){
        ProductList::findOrFail($list_id)->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExtraGroup;
use App\Models\Extra;
use App\Models\Product;
use App\MyFacades\Facades\Slug;

class ExtraController extends Controller
{
    public function index(){
        $extraGroups = ExtraGroup::all();
        return view('extra.index', compact('extraGroups'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        ExtraGroup::Create([
            'name' => $request->input('name'),
            'slug' => Slug::createSlug($request->input('name'), ExtraGroup::class)

        ]);
        return redirect()->back();
    }
    public function storeExtra(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);
        
        $extraGroup = ExtraGroup::findOrFail($id);
        Extra::create([
            'extra_group_id' => $id,
            'name'=> $request->input('name'),
            'slug'=> Slug::createSlug($request->input('name'), Extra::class),
            'price'=> $request->input('price'),
        ]);
        return redirect()->back();
    }

    public function destroy($id){
        ExtraGroup::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function destroyExtra($id){
        Extra::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function attachExtragroup(Request $request,$product_id){
        if(!$request->has('extragroup_id')){
            return redirect()->back();
        }

        $product = Product::findOrFail($product_id);
        $extraGroup = ExtraGroup::findOrFail($request->input('extragroup_id'));
        $product->extragroups()->attach($extraGroup->id);
        return redirect()->back();
    }
    public function detachExtragroup(Request $request,$product_id, $extragroup_id){
        $product = Product::findOrFail($product_id);
        $extraGroup = ExtraGroup::findOrFail($extragroup_id);
        $product->extragroups()->detach($extraGroup->id);
        return redirect()->back();
    }
}

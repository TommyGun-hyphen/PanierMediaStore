<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
class CategoryController extends Controller
{
    public function showProducts($category_slug){
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $products = Product::whereIn('sub_category', function($query) use ($category){
            $query->select('id')->from('sub_categories')->where('category', $category->id);
        })->get();
        return view('category/showProducts', compact('products'));
    }
    public function adminShowProducts($category_slug){
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $products = Product::whereIn('sub_category', function($query) use ($category){
            $query->select('id')->from('sub_categories')->where('category', $category->id);
        })->get();
        return view('category/adminShowProducts', compact('category','products'));
    }
    public function showSubProducts($category_slug, $subcategory_slug){
        $products = Product::where('sub_category', $subcategory_slug)->get();
        return view('category/showProducts', compact('products'));
    }
    public function adminIndex(){
        $categories = Category::all();
        return view('category/adminIndex', compact('categories') );
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories'
        ]);
        if($validator->fails()){
            return response()->json(["msg"=>$validator->errors()->first()], 400);
        }
        $category = Category::create([
            'name'=> $request->input('name'),
            'slug' => str_slug($request->input('name'), '-')
        ]);
        return response()->json($category, 201);
    }
    public function destroy($id){
        try{
            Category::findOrFail($id)->delete();
        }catch(\Illuminate\Database\QueryException $ex){
            return redirect()->back()->with('error', 'cette catégorie a des sous-catégories. vous ne pouvez pas le supprimer');
        }
        return redirect()->back();
    }

    public function adminShow($category_slug){
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $subcategories = SubCategory::where('category', $category->id)->get();
        $products = Product::filter()->paginate(15);
        return view('category.adminShow', compact('category', 'subcategories', 'products'));
    }

    public function getSubCategories($category){
        if(Category::where('id', $category)->exists()){
            $subcategories = SubCategory::where('category', $category)->get();
            return response()->json($subcategories, 200);
        }else{
            return response()->json(["msg"=> "category n'existe pas"], 400);
        }
        return response()->json('fuck');
    }

    public function show($category_slug){
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $subcategories = SubCategory::where('category', $category->id)->get();
        $products = Product::filter()->whereIn('sub_category', array_map(function($subcat){return $subcat['id'];}, $subcategories->toArray()))->paginate(15);
        return view('category.show', compact('subcategories', 'products', 'category'));
    }
}

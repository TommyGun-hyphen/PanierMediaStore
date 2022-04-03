<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\MyFacades\Facades\Slug;
class SubCategoryController extends Controller
{
    public function destroy($id){
        try{
            SubCategory::find($id)->delete();
        }catch(\Illuminate\Database\QueryException $ex){
            return redirect()->back()->with('error', 'des produits appartiennent à cette sous-catégorie. vous ne pouvez pas le supprimer');
        }
        return redirect()->back();
    }
    public function store(Request $request, $category){
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(["msg"=>$validator->errors()->first()], 400);
        }

        if(!Category::where('id', $category)->exists()){
            //!CATEGORY NOT EXISTS
            return response()->json(["msg"=>"scategory does not exist"], 400);
        }

        if(SubCategory::where('category', $category)->where('name', $request->input('name'))->exists()){
            return response()->json(["msg"=>"subcategory name sould be unique per category"], 400);
        }

        $subcategory = SubCategory::create([
            'category'=> $category,
            'name'=> $request->input('name'),
            'slug' => str_slug($request->input('name'), '-')
        ]);

        return response()->json($subcategory, 201);
    }
    public function show(){
        dd(Slug::testingFacades());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\models\Product;
use App\models\Category;
use App\Models\SubCategory;
use App\models\ProductImage;
use App\models\ExtraGroup;
use App\MyFacades\Facades\Slug;
class ProductController extends Controller
{
    public function adminIndex(Request $request){
        
        $products = Product::filter()->paginate(15);
        $categories = Category::all();
        return view('product.adminIndex', compact('products', 'categories'));
    }

    public function create(){
        $categories = Category::all();
        return view('product/create', compact('categories'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'price_old' => 'numeric',
            'sub_category' => 'required|numeric',
        ]);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName = Str::uuid().'.'.$image->getClientOriginalExtension();
            $destination_path = public_path('images');
            $img = Image::make($image->getRealPath());
            $img->resize(1000,1000, function($constraint){
                $constraint->aspectRatio();
            });

            $img->save($destination_path .'\\'. $fileName);
        }
        $validated = $request->all();
        $validated["image_url"] = '/images/'.$fileName;
        $validated["slug"] = Slug::createSlug($request->input('name'), Product::class);
        //dd($validated);
        //dd($validated);
        Product::create($validated);
        return redirect('/admin/product');
    }
    public function destroy($id){
        $product_images = ProductImage::where('product_id', $id)->get();
        $product_images_links = array_map(function($image){
            return $image->image_url;
        }, $product_images);
        $product = Product::find($id);
        File::delete( $product->image_url, ...$product_images_links);

        $product->delete();
        
        return redirect('/admin/product');
    }
    public function adminShow($product_slug){
        $categories = Category::all();
        $product = Product::where('slug', $product_slug)->firstOrFail();
        $extragroups = ExtraGroup::whereNotIn('id', array_map(function($e){
            return $e['id'];
        }, $product->extragroups()->get()->toArray() ))->get();

        return view('product.adminShow', compact('product', 'categories', 'extragroups'));
    }
    public function show($product_slug){
        $product = Product::where('slug', $product_slug)->firstOrFail();
        return view('product.show', compact('product'));
    }

    public function update(Request $request, $product_id){
        $product = Product::findOrFail($product_id);
        $request->validate([
            'name' =>' required',
            'description' => 'required',
            'price' => 'required|numeric',
            'price_old' => 'numeric',
            'sub_category' => 'required|numeric',
        ]);
        $allowedfileExtension=['jpeg','jpg','png'];
        if($request->hasFile('image')){
            $image = $request->file('image');
            if(in_array($image->getClientOriginalExtension(), $allowedfileExtension)){
                $img = Image::make($image->getRealPath());
            $img->resize(1000,1000, function($constraint){
                $constraint->aspectRatio();
            });

            $img->save(public_path().$product->image_url);
            }
        }
        $product->update($request->all());
        return redirect()->back();
    }
    
    public function storeImages(Request $request, $product_id){
        if(!Product::where('id', $product_id)->exists()){
            return response()->json(['msg', 'product does not exist'], 400);
        }
        $files = [];
        if($request->hasFile('images')){
            $files = $request->file('images');
        }
        $allowedfileExtension=['jpeg','jpg','png'];
        $product_images = [];
        foreach($files as $file){
            if(!in_array($file->getClientOriginalExtension(), $allowedfileExtension)){
                continue;
            }
            $fileName = Str::uuid().'.'.$file->getClientOriginalExtension();
            $destination_path = public_path('images');
            $img = Image::make($file->getRealPath());
            $img->resize(1000,1000, function($constraint){
                $constraint->aspectRatio();
            });

            $img->save($destination_path .'\\'. $fileName);
            $product_images[] = ProductImage::create([
                'product_id' => $product_id,
                'image_url' => '/images/'.$fileName
            ]);
            
        }
        return redirect()->back();
    }
    public function destroyImage($image_id){
        ProductImage::find($image_id)->delete();
        return response()->json($image_id, 200);
    }

}

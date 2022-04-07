<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'adminIndex']);
Route::get('/category/{category_slug}', [App\Http\Controllers\CategoryController::class, 'adminShow'] );
Route::delete('/subcategory/{id}', [App\Http\Controllers\SubCategoryController::class, 'destroy']);
Route::get('/subcategory/{subcategory_slug}', [App\Http\Controllers\SubCategoryController::class, 'show']);
Route::get('/category/{category_slug}/products', [App\Http\Controllers\CategoryController::class, 'adminShowProducts']);

Route::get('/product', [App\Http\Controllers\ProductController::class, 'adminIndex']);
Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create']);
Route::post('/product', [App\Http\Controllers\ProductController::class, 'store']);
Route::get('/product/{product_slug}', [App\Http\Controllers\ProductController::class, 'adminShow']);
Route::delete('/product/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);
Route::delete('/product/{id}/force', [App\Http\Controllers\ProductController::class, 'destroyForce']);
Route::put('/product/{product_id}', [App\Http\Controllers\ProductController::class, 'update']);
Route::get('/product/{product_id}/forceDelete', function($product_id){
    $product = App\Models\Product::findOrFail($product_id);
    return view('product.forceDelete', compact('product'));
});
Route::post('/product/{product_id}/image', [App\Http\Controllers\ProductController::class, 'storeImages']);
Route::post('/image/{image_id}', [App\Http\Controllers\ProductController::class, 'destroyImage']);


//extras

Route::get('/extra', [App\Http\Controllers\ExtraController::class, 'index']);
Route::post('/extragroup', [App\Http\Controllers\ExtraController::class, 'store']);
Route::post('/extragroup/{id}/extra', [App\Http\Controllers\ExtraController::class, 'storeExtra']);

Route::delete('/extragroup/{id}', [App\Http\Controllers\ExtraController::class, 'destroy']);
Route::delete('/extra/{id}', [App\Http\Controllers\ExtraController::class, 'destroyExtra']);
Route::post('/product/{product_id}/extragroup', [App\Http\Controllers\ExtraController::class, 'attachExtragroup']);
Route::delete('/product/{product_id}/extragroup/{extragroup_id}', [App\Http\Controllers\ExtraController::class, 'detachExtragroup']);

Route::get('/slider', [App\Http\Controllers\SliderItemController::class, 'index']);
Route::post('/slider', [App\Http\Controllers\SliderItemController::class, 'store']);
Route::delete('/slider/{item_id}', [App\Http\Controllers\SliderItemController::class, 'destroy']);

Route::get('/list', [App\Http\Controllers\ProductListController::class, 'index']);
Route::post('/list', [App\Http\Controllers\ProductListController::class, 'store']);
Route::get('/list/{list_id}', [App\Http\Controllers\ProductListController::class, 'show']);
Route::delete('/list/{list_id}', [App\Http\Controllers\ProductListController::class, 'destroy']);
Route::post('/list/{list_id}', [App\Http\Controllers\ProductListController::class, 'storeProduct']);
Route::delete('/list/{list_id}/{product_id}', [App\Http\Controllers\ProductListController::class, 'destroyProduct']);
Route::get('/settings', function(){
    $settings = App\Models\Setting::all();
    return view('settings', compact('settings'));
});
Route::post('/settings', function(Request $request){
    foreach(App\Models\Setting::all() as $setting){
        
        App\Models\Setting::where('key', $setting->key)->update([
            'value' => $request->input($setting->key)
        ]);
    }
    return redirect()->back();
});

Route::get('/order', function(){
    $orders = App\Models\Order::orderBy('created_at', 'DESC')->paginate(20);
    foreach($orders as $order){
        $total = 0;
        $orderDetails = $order->details()->get();
        foreach($orderDetails as $detail){
            $curr = $detail->price;
            foreach($detail->extras()->get() as $extra){
                $curr+=$extra->price;
            }
            $total+=$curr;
        }
        $order->total = $total;
    }
    return view('order.index', compact('orders'));
});
Route::get('/order/{order_id}', function($order_id){
    $order = App\Models\Order::findOrFail($order_id);
    $total = 0;
        $orderDetails = $order->details()->get();
        foreach($orderDetails as $detail){
            $curr = $detail->price;
            foreach($detail->extras()->get() as $extra){
                $curr+=$extra->price;
            }
            $total+=$curr;
        }
        $order->total = $total;
    return view('order.show', compact('order'));
});
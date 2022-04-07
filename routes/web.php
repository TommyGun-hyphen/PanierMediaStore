<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //$products = App\Models\Product::filter()->paginate(15);
    $categories = App\Models\Category::all();
    return view('index', compact('categories'));
});

Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/category/{category_slug}', [App\Http\Controllers\CategoryController::class, 'showProducts'])->name('home');

Route::post('/category', [App\Http\Controllers\CategoryController::class, 'store']);
Route::delete('/category/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);
Route::get('/category/{id}/subcategory', [App\Http\Controllers\CategoryController::class, 'getSubCategories']);
Route::get('/category/{category_slug}/{subcategory_slug}', [App\Http\Controllers\CategoryController::class, 'showProducts'])->name('home');

Route::post('/category/{category_slug}/subcategory', [App\Http\Controllers\SubCategoryController::class, 'store']);

Route::get('/category/{category_slug}', [App\Http\Controllers\CategoryController::class, 'show']);

Route::get('/product/{product_slug}', [App\Http\Controllers\ProductController::class, 'show']);
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search']);
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index']);
Route::post('/cart', [App\Http\Controllers\CartController::class, 'store']);
Route::put('/cart', [App\Http\Controllers\CartController::class, 'update']);
Route::get('/cart/undo', [App\Http\Controllers\CartController::class, 'undo']);
Route::delete('/cart/{product_id}', [App\Http\Controllers\CartController::class, 'destroy']);


Route::post('/order', function(Request $request){
    $request->validate([
        'fullname' => 'required',
        'phone' => 'required',
        'city' => 'required',
    ]);
    if(!request()->session()->has('cart_products')){
        return redirect()->back();
    }
    $cart_products = $request->session()->get('cart_products');
    $order = App\Models\Order::create($request->all());
    $cart_extras = $request->session()->get('cart_extras');
    foreach(array_keys($cart_products) as $entry){
        $product = App\Models\Product::find($entry);
        if($product == null) continue;
        $orderDetail = App\Models\OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $entry,
            'quantity' => $cart_products[$entry],
            'price' => $product->price
        ]);
        if(isset($cart_extras[$entry])){
            foreach($cart_extras[$entry][0] as $extra){
                $orderDetail->extras()->attach($extra);
            }
        }
    }
    $request->session()->flush();
    return redirect('/merci')->with('fullname', $request->input('fullname'));
});

Route::get('/merci', function(){
    return view('merci');
});
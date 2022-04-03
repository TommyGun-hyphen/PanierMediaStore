<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'adminIndex']);
Route::get('/category/{category_slug}', [App\Http\Controllers\CategoryController::class, 'adminShow'] );
Route::delete('/subcategory/{id}', [App\Http\Controllers\SubCategoryController::class, 'destroy']);
Route::get('/subcategory/{id}', [App\Http\Controllers\SubCategoryController::class, 'show']);
Route::get('/category/{category_slug}/products', [App\Http\Controllers\CategoryController::class, 'adminShowProducts']);

Route::get('/product', [App\Http\Controllers\ProductController::class, 'adminIndex']);
Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create']);
Route::post('/product', [App\Http\Controllers\ProductController::class, 'store']);
Route::get('/product/{product_slug}', [App\Http\Controllers\ProductController::class, 'adminShow']);
Route::delete('/product/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);
Route::put('/product/{product_id}', [App\Http\Controllers\ProductController::class, 'update']);

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

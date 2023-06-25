<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| All Web Routes are registered in here... 
|--------------------------------------------------------------------------
*/

// this is the root
Route::get('/', function () {
    return view('auth.login');
});

// disable register toute
Route::get('/register', function () {
    return view('auth.login');
});

//return 404 when user enter wrong URL
Route::fallback(function(){
    return view('admin.pages.404');
});

// Auth::routes();
Auth::routes(['register' => false]);

// when user enter the correct admin login info, 
// he/she will redirect to the dashboard which is registered in (/home) route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('home');

// within this controller will handle all the admin dashboard routes
Route::controller(AdminController::class)->group(function () {

		Route::get('/admin', 'index');
		Route::get('/add-product', 'goto_AddProductsTab');
		Route::get('/edit-product', 'goto_EditProductsTab');
        Route::get('/product-list', 'goto_ProductListTab');
        Route::get('/categories', 'goto_CategoriesTab');
        Route::get('/orders', 'goto_OrdersTab');
        
});


// Category manage routes ===> ===> ===> ===> ===>
Route::controller(CategoryController::class)->group(function(){
        // main
    Route::post('/add-main-category', 'save_mainCategory');
    Route::get('/delete-main-category/{id}', 'delete_mainCategory');
    Route::get('/edit-main-category/{id}', 'edit_mainCategory');
    Route::post('/update-main-category/{id}', 'update_mainCategory');

        // sub
    Route::post('/add-subcategory', 'save_subcategory');
    Route::get('/edit-sub-category/{id}', 'edit_subCategory');
    Route::post('/update-sub-category/{id}', 'update_subCategory');
    Route::get('/delete-sub-category/{id}', 'delete_subCategory');
    
});


// Category manage routes end


// Product manage routes ===> ===> ===> ===> ===>
Route::controller(ProductController::class)->group(function(){
    Route::post('/create-product', 'save_Product');
    Route::get('/edit-product/{id}', 'edit_Product');
    Route::post('/update-product/{id}', 'update_Product');
});

// product manage routes end


// Order manage routes ===> ===> ===> ===> ===> ===>


// Order manage routes end
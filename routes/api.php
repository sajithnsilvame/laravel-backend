<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SubCategoryController;
use App\Http\Controllers\API\MainCategoryController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\OrderInfoController;

/*
|--------------------------------------------------------------------------
| All API Routes are registered in here..
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/logout', [AuthController::class,'logout']);
    
});

//Route::post('/get-token', [AuthController::class, 'getToken']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// view sub category list
Route::get('/sub-categories', [SubCategoryController::class, 'view_subcategoryList']);


// main category list
Route::get('/categories', [MainCategoryController::class, 'view_MainCategory']);

// products
Route::get('/products', [ProductController::class, 'view_Product']);

// single product
Route::get('/view-product/{id}', [ProductController::class, 'view_SingleProduct']);

// generate-payment-intent
Route::post('/payment-intent', [PaymentController::class, 'make_payment']);

// order info
Route::post('/order-details', [OrderInfoController::class, 'order_info']);



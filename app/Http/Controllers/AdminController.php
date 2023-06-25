<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categories;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function index(){
        if(Auth::id()){
            return view('admin.components.index');
        }
        else{
            return view('auth.login');
        }
        
        
    }

    public function goto_AddProductsTab(){
        if(Auth::id()){
            $main_Categories = Categories::all();
            $sub_Categories = SubCategory::all();
            return view('admin.pages.addProducts', compact('main_Categories','sub_Categories'));
        }
        else{
           return view('auth.login'); 
        }
        
    }

    public function goto_EditProductsTab(){
        if(Auth::id()){
            return view('admin.pages.editProducts');
        }
        else{
           return view('auth.login'); 
        }
        
    }

    public function goto_ProductListTab(){
        if(Auth::id()){

            $products = Product::all();
            //dd($products);
            return view('admin.pages.productList',compact('products'));
        }
        else{
           return view('auth.login'); 
        }
        
    }

    public function goto_CategoriesTab(){
    
        if(Auth::id()){
            $sub_category = SubCategory::all();
            $main_category = Categories::all();
            
            return view('admin.pages.categories',compact('sub_category','main_category'));
        }
        else{
           return view('auth.login'); 
        }
        
    }


    public function goto_OrdersTab(){
        if(Auth::id()){
            return view('admin.pages.orders');
        }
        else{
           return view('auth.login'); 
        }
        
    }
}







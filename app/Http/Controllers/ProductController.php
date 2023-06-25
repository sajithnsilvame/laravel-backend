<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categories;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function save_Product(Request $request) {

        // Define validation rules
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
            'size' => 'required',
            'color' => 'required',
            'main_category' => 'required',
            'sub_category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:7168',
            'price' => 'required|numeric|min:0',
            'dis_price' => 'nullable|numeric|min:0',
            'qty' => 'required|numeric|min:0',
        ];

        // Define custom error messages
        $messages = [
            'title.required' => 'Product title is required.',
            'title.max' => 'Product title cannot be more than :max characters.',
            'description.required' => 'Product description is required.',
            'size.required' => 'Product size is required.',
            'color.required' => 'Product color is required.',
            'main_category.required' => 'Main category is required.',
            'sub_category.required' => 'Sub category is required.',
            'image.required' => 'Product image is required.',
            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Uploaded image must be of type: :values.',
            'image.max' => 'Uploaded image cannot be more than :max KB.',
            'price.required' => 'Product price is required.',
            'price.numeric' => 'Product price must be a number.',
            'price.min' => 'Product price cannot be less than :min.',
            'dis_price.numeric' => 'Discount price must be a number.',
            'dis_price.min' => 'Discount price cannot be less than :min.',
            'qty.required' => 'Product quantity is required.',
            'qty.numeric' => 'Product quantity must be a number.',
            'qty.min' => 'Product quantity cannot be less than :min.',
        ];

        // Validate the incoming request data
            $validator = Validator::make($request->all(), $rules, $messages);

            // If validation fails, redirect back with error messages
            if ($validator->fails()){
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            } 
            else{

                try{
                    $product = new Product();

                    $product->title = $request->title;
                    $product->description = $request->description;
                    $product->size = json_encode($request->size);
                    $product->color = json_encode($request->color);
                    $product->main_category = $request->main_category;
                    $product->sub_category = json_encode($request->sub_category);  
                    
                    $image = $request->file('image');
                    $image_name = $image->getClientOriginalName();
                    $image_path = $image->storeAs('public/images/products', $image_name);
                    $product->image = $image_path; 
                
                    $product->price = $request->price;
                    $product->discount_price = $request->dis_price;
                    $product->quantity = $request->qty;    

                    $product->save();
                    return redirect()->back()->with('productSavemessage', 'Product Createded Successfully');

                }catch(\Exception $e) {
                    // Handle any exceptions that are thrown
                    dd($e->getMessage());
                }

            }
    
    }

    public function edit_Product($id){

        if(Auth::id()){

            $product = Product::findOrFail($id);
            $main_Categories = Categories::all();
            $sub_Categories = SubCategory::all();
            //dd($product);
            return view('admin.pages.editProduct', compact('product','main_Categories','sub_Categories'));
        }
        else{
            return redi('auth.login');
        }
        
    }

    public function update_Product(Request $request, $id){

        if(Auth::id()){

            $product = Product::findOrFail($id);

            // Define validation rules
            $rules = [
                'title' => 'required|max:255',
                'description' => 'required',
                'size' => 'required',
                'color' => 'required',
                'main_category' => 'required',
                'sub_category' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:7168',
                'price' => 'required|numeric|min:0',
                'dis_price' => 'nullable|numeric|min:0',
                'qty' => 'required|numeric|min:0',
            ];

            // Define custom error messages
            $productupdateErrorMessages = [
                'title.required' => 'Product title is required.',
                'title.max' => 'Product title cannot be more than :max characters.',
                'description.required' => 'Product description is required.',
                'size.required' => 'Product size is required.',
                'color.required' => 'Product color is required.',
                'main_category.required' => 'Main category is required.',
                'sub_category.required' => 'Sub category is required.',
                'image.required' => 'Product image is required.',
                'image.image' => 'Uploaded file must be an image.',
                'image.mimes' => 'Uploaded image must be of type: :values.',
                'image.max' => 'Uploaded image cannot be more than :max KB.',
                'price.required' => 'Product price is required.',
                'price.numeric' => 'Product price must be a number.',
                'price.min' => 'Product price cannot be less than :min.',
                'dis_price.numeric' => 'Discount price must be a number.',
                'dis_price.min' => 'Discount price cannot be less than :min.',
                'qty.required' => 'Product quantity is required.',
                'qty.numeric' => 'Product quantity must be a number.',
                'qty.min' => 'Product quantity cannot be less than :min.',
            ];

            $validator = Validator::make($request->all(), $rules, $productupdateErrorMessages);

        if($validator->fails()){

        }
        }else{
            return redirect('login');
        }
        
    }
}

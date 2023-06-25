<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Main

    public function save_mainCategory(Request $request){
        if(Auth::id()){
            

            // Validation rules for category name and image
            $rules = [
                'name' => 'required | unique:categories|max:255',
                'image' => 'required | image|mimes:jpeg,png,jpg,gif|max:7168',
            ];

            // Custom error messages for validation rules
            $mainCategoryErrorMessages = [
            'name.required' => 'Main Category name is required.',
            'name.unique' => 'This Main Category name is already taken.',
            'name.max' => 'Category name cannot be more than :max characters.',
            'image.required' => 'Main Category image is required.',
            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Uploaded image must be of type: :values.',
            'image.max' => 'Uploaded image cannot be more than :max KB.',
            ];

            // Validate the incoming request data
            $validator = Validator::make($request->all(), $rules, $mainCategoryErrorMessages);

            // If validation fails, redirect back with error messages
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $data = new Categories();
                $data->name = $request->name;
                            
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                $image_path = $image->storeAs('public/images/categories', $image_name);
                $data->image = $image_path;    
                    
                //dd($data);
                $data->save();
                return redirect()->back()->with('mainmessage', 'Main Category Added Successfully');
            }

   
        }
        else{
            return redirect('login');
        }       
    }

    public function delete_mainCategory($id){ 
        if(Auth::id()){
            $category = Categories::findOrFail($id);
            $category->delete();
            return redirect()->back()->with('mainDeleteMessage', 'Category is deleted successfully');
        }
        else{
            return redirect('login');
        }
        
    }

    public function edit_mainCategory($id){ 
        if(Auth::id()){
            $main_category = Categories::findOrFail($id);
            return view('admin.pages.editMainCategory', compact('main_category'));
        }
        else{
            return redirect('login');
        }
        
        
    }

    public function update_mainCategory(Request $request, $id){
        if(Auth::id()){

            $main_category = Categories::findOrFail($id);

            // Validation rules for category name and image
            $rules = [
                'name' => 'required|unique:categories,name,'.$main_category->id.'|max:255',
                'image' => 'nullable | image|mimes:jpeg,png,jpg,gif|max:7168',
            ];

            // Custom error messages for validation rules
            $messages = [
            'name.required' => 'Main Category name is required.',
            'name.unique' => 'This Main Category name is already taken.',
            'name.max' => 'Category name cannot be more than :max characters.',
            'image.required' => 'Main Category image is required.',
            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Uploaded image must be of type: :values.',
            'image.max' => 'Uploaded image cannot be more than :max KB.',
            ];

            // Validate the incoming request data
            $validator = Validator::make($request->all(), $rules, $messages);

            // If validation fails, redirect back with error messages
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {

                $main_category->name = $request->name;

                if ($request->hasFile('image')) {

                    $image = $request->file('image');
                    $image_name = $image->getClientOriginalName();
                    $image_path = $image->storeAs('public/images/categories', $image_name);
                    $main_category->image = $image_path;
                }

                $main_category->save();

                return redirect()->back()->with('mainUpdatemessage', 'Category is updated successfully');
            }

        }
        else{ 
            return redirect('login');
        }
        
    }














        // Sub 
    public function save_subCategory(Request $request){
            
        if(Auth::id()){

            // Validation rules for category name and image
            $rules = [
                'category_name' => 'required | unique:sub_categories|max:255',
            ];

            // Custom error messages for validation rules
            $subCategoryErrorMessages = [
            'category_name.required' => 'Sub Category name is required.',
            'category_name.unique' => 'This Sub Category name is already taken.',
            'category_name.max' => 'Category name cannot be more than :max characters.',
            ];

            // Validate the incoming request data
            $validator = Validator::make($request->all(), $rules, $subCategoryErrorMessages);

            // If validation fails, redirect back with error messages
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }else{
               $data = new SubCategory();

                $data->category_name = $request->category_name;
                $data->category_des = $request->category_des;
                
                $data->save();
                return redirect()->back()->with('subMessage', 'Sub Category Added Successfully');     
            }
        }
        else{
            return redirect('login');
        }
    }

    public function edit_subCategory($id){
        if(Auth::id()){
            $sub_category = SubCategory::findOrFail($id);
            //dd($sub_category);
            return view('admin.pages.editSubCategory', compact('sub_category'));
        }
        else{
            return redirect('login');
        }
    }

    public function update_subCategory(Request $request, $id){
         $sub_category = SubCategory::findOrFail($id);

         $sub_category->category_name = $request->category_name;
         $sub_category->category_des = $request->category_des;

         return redirect()->back()->with('subUpdateMessage', 'Category Updated Successfully');
    }

    public function delete_subCategory($id) {
        $sub_category = SubCategory::findOrFail($id);
        $sub_category->delete();
        return redirect()->back()->with('subDeleteMessage', 'Category Deleted Successfully');
    }

    
}

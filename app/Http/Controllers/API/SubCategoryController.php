<?php

namespace App\Http\Controllers\API;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function view_subcategoryList(){
        $sub_categories = SubCategory::all();
        return response()->json([
            'status' => 200,
            'sub_categories' => $sub_categories
        ]);
    }
}

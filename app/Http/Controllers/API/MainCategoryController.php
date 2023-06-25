<?php

namespace App\Http\Controllers\API;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainCategoryController extends Controller
{
    public function view_MainCategory(){
        $categories = Categories::all();
        $headers = [
            'Access-Control-Allow-Credentials' => 'true',
            'Access-control-allow-origin' => 'http://localhost:3000/',
            'Access-Control-Allow-Methods' => 'GET',
            'Access-Control-Allow-Headers' => 'application/json',
            'Content-Type' => 'application/json'
        ];
        return response()->json([
            'status' => 200,
            'categories' => $categories,
            'headers' => $headers
        ]);

        
        
    }
}

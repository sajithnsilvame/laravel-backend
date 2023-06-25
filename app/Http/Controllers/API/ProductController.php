<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function view_Product(){
        $products = Product::all();

        foreach ($products as &$product) {
            $product->size = json_decode($product->size);
            $product->color = json_decode($product->color);
            $product->sub_category = json_decode($product->sub_category);
        }

        $headers = [
            'Access-Control-Allow-Credentials' => 'true',
            'Access-control-allow-origin' => 'http://localhost:3000/',
            'Access-Control-Allow-Methods' => 'GET',
            'Access-Control-Allow-Headers' => 'application/json',
            'Content-Type' => 'application/json'
        ];
        return response()->json([
            'status' => 200,
            'products' => $products,
            'headers' => $headers
        ]);
    }

    public function view_SingleProduct($id){
    
        $product = Product::findOrFail($id);

        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found'
            ], 404);
        }
        else{
            $product->size = json_decode($product->size);
            $product->color = json_decode($product->color);
            $product->sub_category = json_decode($product->sub_category);

            $headers = [
                'Access-Control-Allow-Credentials' => 'true',
                'Access-control-allow-origin' => 'http://localhost:3000/',
                'Access-Control-Allow-Methods' => 'GET',
                'Access-Control-Allow-Headers' => 'application/json',
                'Content-Type' => 'application/json'
            ];
            return response()->json([
                'status' => 200,
                'product' => $product,
                'headers' => $headers
            ]);
        }

        

    }


    
}

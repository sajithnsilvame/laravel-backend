<?php

namespace App\Http\Controllers\API;


use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderInfoController extends Controller
{
    public function order_info(Request $request ) {

        Log::channel('slack')->info('hello world from order info'); 


         
            // $orderData = $request->input('order');
            // $userData = $request->input('user');

            // foreach ($orderData as $order_data) {
            //     $orders = new Order();

            //    $orders->title = $order_data['title'];

            //    $image = $order_data['image'];
            //    $image_name = $image->getClientOriginalName();
            //    $image_path = $image->storeAs('public/images/orders', $image_name);
            //    $orders->image = $image_path; 

            //    $orders->qty = $order_data['quantity'];
            //    $orders->price = $order_data['price'];
            //    $orders->size = $order_data['size'];
            //    $orders->color = $order_data['color'];
            //    $orders->total = $order_data['quantity'] * $order_data['price'];

            //     $orders->save();

            // }

            $orederData = $request->all();

            foreach($orederData as $key => $value){
                
                // if($key == 'order'){
                //     foreach($value as $order ){
                        
                //         Order::create($order);

                        

                //     }
                    
                // }
                // else{
                //     foreach($value as $user){
                            
                //             Order::create([
                //             'cus_name' => $user['name'],
                //             'mobile' => $user['mobile'],
                //             'email' => $user['email'],
                //             'address' => $user['address'],
                //         ]);
                //     }

                    

                    
                // }

                foreach($value as $order ){  
                    Order::create($order);
                }
                foreach($value as $user){
                            
                    Order::create([
                        'cus_name' => $user['name'],
                        'mobile' => $user['mobile'],
                        'email' => $user['email'],
                        'address' => $user['address'],
                    ]);
                }


                

                return response()->json([
                'status' => 200,
                'orederData' => $orederData,
                ],200);
            
            
         
        
        
        }

    }
}

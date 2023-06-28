<?php

namespace App\Http\Controllers\API;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\CardException;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function make_payment(Request $request)
    {

        $data = $request->all();
        $amount = $request->input('amount');
        $apiKey = env('STRIPE_SECRET');

        Stripe::setApiKey($apiKey);

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $amount * 100,
            'currency' => 'usd',
            'payment_method' => $request->input('payment_method'),
            'source' => $request->stripeToken,
            'description' => 'Payment from customer',
        ]);

        //order create
        //order user info
        $userOrder = [
            'cus_name' => $data['order_info']['user'][0]['fname'] . " " . $data['order_info']['user'][0]['lname'],
            'mobile' => $data['order_info']['user'][0]['mobile'],
            'email' => $data['order_info']['user'][0]['email'],
            'address' => $data['order_info']['user'][0]['address'],
            'city' => $data['order_info']['user'][0]['city'],
        ];
        //order item info
        foreach ($data['order_info']['order'] as $post) {
            //order user create
            $orderCreate =  Order::create($userOrder);
            $orderItem = [
                'title' => $post['title'],
                'image' => $post['image'],
                'qty' => $post['quantity'],
                'price' => $post['price'],
                'size' =>    $post['size'],
                'color' => $post['color'],
                'total' => $post['price'],
            ];
            //order item create
            $orderCreate->update($orderItem);
        }


        return response()->json([
            'client_secret' => $intent->client_secret,
        ]);
    }
}



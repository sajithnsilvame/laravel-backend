<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Exception\CardException;

class PaymentController extends Controller
{
    public function make_payment(Request $request){
        
        
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

        return response()->json([
            'client_secret' => $intent->client_secret,
        ]);
    }
}

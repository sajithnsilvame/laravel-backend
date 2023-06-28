<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Exception\CardException;

class PaymentController extends Controller
{
    public function make_payment(Request $request)
    {


        $amount = $request->input('amount');
        //$stripeAPIKey = env('STRIPE_SECRET');
        $order_info = $request->input('order_info');

        Stripe::setApiKey('sk_test_51NHMI3IcPN2M0dwToDFb1YiDlmRM4Z7FWF0bcYxabm8HDLv1Xk2xVsuLlxnzH81LhqGE0HuWOwRgkS3Pi2Tpb3my00CeMOtZ6H');

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $amount * 100,
            'currency' => 'usd',
            'payment_method' => $request->input('payment_method'),
            'source' => $request->stripeToken,
            'description' => 'Payment from customer',
        ]);


        // order data save logic





        // =>

        return response()->json([
            'client_secret' => $intent->client_secret,
            'order_info' => $order_info,
        ]);
    }
}
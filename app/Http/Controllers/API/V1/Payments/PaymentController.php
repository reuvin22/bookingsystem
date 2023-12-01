<?php

namespace App\Http\Controllers\API\V1\Payments;

use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $data = $request->json()->all();
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe->paymentIntents->create([
            'amount' => $data['amount'] * 100,
            'currency' => 'usd',
            'payment_method' => 'pm_card_visa',
        ]);

        return response()->json(['status' => 200, 'message' => 'Payment has been made!']);
    }
}

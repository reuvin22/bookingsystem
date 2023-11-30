<?php

namespace App\Http\Controllers\API\V1\Payments;

use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $cardDetails = $stripe->tokens->create([
            'card' => [
                'number' => $request->number,
                'exp_month' => $request->exp_month,
                'exp_year' => $request->exp_year,
                'cvc' => $request->cvc,
            ],
        ]);

        $stripe->charges->create([
            'amount' => $request->amount,
            'currency' => 'usd',
            'source' => $cardDetails->id,
            'description' => $request->description,
        ]);

        return response()->json(['status' => 200, 'message' => 'Payment has been made!']);
    }
}

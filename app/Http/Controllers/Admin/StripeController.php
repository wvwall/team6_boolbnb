<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe;
use Session;
class StripeController extends Controller
{
    public function stripeCheckout(Request $request)
{
    $secret_key = env('STRIPE_SECRET_KEY');
    \Stripe\Stripe::setApiKey($secret_key);
    
    $amount = (int) str_replace('.', '', $request->get('total'));
    
    $intent = \Stripe\PaymentIntent::create([
            'amount' => $amount * 100,
            'currency' => 'eur',
            'metadata' => ['integration_check' => 'accept_a_payment']
        ]);
    return response()->json(['secret' => $intent->client_secret]);    
}
}

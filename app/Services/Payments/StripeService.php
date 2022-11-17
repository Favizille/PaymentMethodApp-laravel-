<?php

namespace App\Services\Payments;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Support\Facades\Session;
use App\Contracts\Payments\PaymentContract;

/**
 *
 */
class StripeService implements PaymentContract
{


    public function handlePost($request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        Charge::create ([
                "amount" => 100 * 150,
                "currency" => "inr",
                "source" => $request->stripeToken,
                "description" => "Making test payment."
        ]);

        Session::flash('success', 'Payment has been successfully processed.');

        return back();
    }

    public function getRedirectPage($request){
        //To DO
    }

    public function processCallback(){
        //To Do
    }

}

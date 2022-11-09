<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;

class PaymentController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function payment(){
        return view('payment');
    }

    public function paymentMethod(){
        return view('paymentMethod');
    }


    public function handleGet()
    {
        return view('home');
    }

    public function billingPortal(Request $request){
        // $user= $request->user()->redirectToBillingPortal(route('payment_view'));
        // dd($user);
        // dd(config('cashier.key'));

        // $user = Cashier::findBillable($stripeId);

        // if($request->user()->stripe_id === null)
        // {
        //     $request->user()->createAsStripeCustomer();
        // }
        // return $request->user()->redirectToBillingPortal(route('payment_view'));

        $request->user()->billingPortalUrl(route('billing'));
    }
}

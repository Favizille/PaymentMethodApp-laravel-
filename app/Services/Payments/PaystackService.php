<?php

namespace App\Services\Payments;

use App\Contracts\Payments\PaymentContract;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaystackService implements PaymentContract
{

    public function __construct()
    {
        $this->paystack = new Paystack();
    }

    public function getRedirectPage($request)
    {
        try{
            // dd(Paystack::getAuthorizationUrl());
            return $this->paystack->getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return redirect()->back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
            // return redirect()->route('payment');
        }
        return $this->paymentContract->getRedirectPage();
    }

    public function processCallback()
    {
        // return $this->paymentContract->processCallback();
    }

    public function handlePost($request){
        // To match the paymentContact
    }
}

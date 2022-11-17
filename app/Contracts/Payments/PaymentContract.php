<?php

namespace App\Contracts\Payments;

use Illuminate\Http\Request;

interface PaymentContract
{
    public function handlePost(Request $request);

    public function getRedirectPage(Request $request);

    public function processCallback();
}

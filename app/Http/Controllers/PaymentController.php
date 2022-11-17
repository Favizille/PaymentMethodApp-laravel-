<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Services\Payments\PaystackService;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{

    protected $paystackService;

    public function __construct(PaystackService $paystackService){
        $this->middleware('auth');
        $this->paystackService = $paystackService;
    }

    public function process(Request $request)
    {
        try {
            return redirect($this->paystackService->getRedirectPage($request));
        }catch(Exception $e){
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function callback()
    {
        try {
            return redirect($this->paymentService->processCallback());
        }catch(Exception $e){ //will be changed
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
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

        if($request->user()->stripe_id === null)
        {
            $request->user()->createAsStripeCustomer();
        }
        return $request->user()->redirectToBillingPortal(route('payment_view'));

        // $request->user()->billingPortalUrl(route('payment_view'));
    }


    public function purchase(Request $request)
    {
        $request->user()->charge(
            100, $request->paymentMethodId
        );

        return $request->user()->redirectToBillingPortal(route('payment_view'));

    }

    // public function redirectToGateway(Request $request)
    // {
    //     try{
    //         return Paystack::getAuthorizationUrl()->redirectNow();
    //     }catch(\Exception $e) {
    //         return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
    //     }
    // }

    // public function handleGatewayCallback()
    // {
    //     $paymentDetails = Paystack::getPaymentData();

    //     dd($paymentDetails);

    //     // $data = array(
    //     //     "amount" => 700 * 100,
    //     //     "reference" => '4g4g5485g8545jg8gj',
    //     //     "email" => 'user@mail.com',
    //     //     "currency" => "NGN",
    //     //     "orderID" => 23456,
    //     // );

    //     // return Paystack::getAuthorizationUrl($data)->redirectNow();


    //     // Now you have the payment details,
    //     // you can store the authorization_code in your db to allow for recurrent subscriptions
    //     // you can then redirect or do whatever you want
    // }

    public function paystackPayment(){
        return view("payment(paystack)");
    }

    // public function handleGatewayCallback()
    // {
    //  //Getting authenticated user
    //     $id = Auth::id();
    //     // Getting the specific student and his details
    //     $student = User::where('user_id',$id)->first();
    //     $class_id = $student->class_id;
    //     $section_id = $student->section_id;
    //     $level_id = $student->level_id;
    //     $student_id = $student->id;

    //     $paymentDetails = Paystack::getPaymentData(); //this comes with all the data needed to process the transaction
    //     // Getting the value via an array method
    //     $inv_id = $paymentDetails['data']['metadata']['invoiceId'];// Getting InvoiceId I passed from the form
    //     $status = $paymentDetails['data']['status']; // Getting the status of the transaction
    //     $amount = $paymentDetails['data']['amount']; //Getting the Amount
    //     $number = $randnum = rand(1111111111,9999999999);// this one is specific to application
    //     $number = 'year'.$number;
    //     // dd($status);
    //     if($status == "success"){ //Checking to Ensure the transaction was succesful

    //         Payment::create(['student_id' => $student_id,'invoice_id'=>$inv_id,'amount'=>$amount,'status'=>1]); // Storing the payment in the database
    //         User::where('user_id', $id)
    //               ->update(['register_no' => $number,'acceptance_status' => 1]);

    //         return view('student.studentFees');
    //     }
    // }


    public function paystackView(){
        return view('paystack');
    }

    public function verify($reference){
        $secretKey= "sk_test_67bafa394862570e65f55ce20269fa38fe4bff93";
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $secretKey",
            "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return [ $reference, $response];
    }
}

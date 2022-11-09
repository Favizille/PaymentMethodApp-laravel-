namespace App\Services\Payments;
use App\Contracts\Payments\PaymentContract;

/**
 *
 */
class StripeService implements PaymentContract
{

    public function handlePost(Request $request)
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
}

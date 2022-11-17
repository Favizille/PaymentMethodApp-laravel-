<!DOCTYPE html>
<html lang="en">
<head>
  <title>Payment Method</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="{{asset("css/paymentMethod.css")}}">
</head>
<body>

    <div class="container px-0">
        <div class="card px-md-4 px-3 pb-4">
            <div class="d-flex flex-column my-3">
                <p class="h8">Payment method</p>
                <p class="text-muted">Choose your payment method to pay</p>
            </div>
            <div class="payment mb-2">
                <a href="{{route("paystack.view")}}">
                    <div class="btn btn-primary">
                        <div>
                            <span class="far fa-credit-card pay"></span>
                            <span class="ps-3">Pay Stack</span>
                        </div>
                        <span class="fas fa-arrow-right"></span>
                    </div>
                </a>
            </div>
            <div class="payment mb-2">
                <a href="#">
                    <div class="btn btn-primary">
                        <div>
                            <span class="fab fa-paypal pay"></span>
                            <span class="ps-3">PayPal</span>
                        </div>
                        <span class="fas fa-arrow-right"></span>
                    </div>
                </a>
            </div>
            <div class="payment mb-2">
                <a href="{{route("billing_portal")}}">
                    <div class="btn btn-primary">
                        <div>
                            <span class="fab fa-bitcoin pay"></span>
                            <span class="ps-3">Stripe</span>
                        </div>
                        <span class="fas fa-arrow-right"></span>
                    </div>
                </a>
            </div>
            <div class="payment mb-2">
                <a href="#">
                    <div class="btn btn-primary">
                        <div>
                            <span class="fas fa-university pay"></span>
                            <span class="ps-3">Cash</span>
                        </div>
                        <span class="fas fa-arrow-right"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>

</body>
</html>

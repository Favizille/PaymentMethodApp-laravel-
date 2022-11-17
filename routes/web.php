<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("/", [AuthController::class, "register"])->name("register_view");
Route::get("/login", [AuthController::class, "login"])->name("login_view");
Route::post("/register", [AuthController::class, "registration"])->name("registration");
Route::post("/loggin", [AuthController::class, "loggin"])->name("login");
Route::get('/logout', [AuthController::class, "logout"])->name("auth.logout");


Route::get('/payment', [PaymentController::class, 'payment'])->name('payment_view');
Route::get('/paymentMethod', [PaymentController::class, 'paymentMethod'])->name('payment_method_view');
// Route::get('/stripe-payment', [PaymentController::class, 'handleGet'])->name("stripe_view");
Route::get('/billing-portal', [PaymentController::class, "billingPortal"])->name("billing_portal");
Route::post('/purchase',[PaymentController::class, "purchase"])->name("purchase");
Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('pay');
Route::post('/get-template', [PaymentController::class, 'process'])->name('templates.pay');
Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback'])->name('payment');
Route::get('/payment/paystack',[PaymentController::class, 'paystackpayment'])->name('paystackpayment');
Route::get('/payments/callback', [PaymentController::class, 'callback'])->name('payments.callback');


Route::get('/payments/paystack_view', [PaymentController::class, 'paystackView'])->name('paystack.view');
Route::get('verify-payment/{reference}',[PaymentController::class, 'verify']);

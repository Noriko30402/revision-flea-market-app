<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;


class StripePaymentController extends Controller
{

    public function  purchase($id){
        $user = Auth::user();
        $profile = $user->profile;

        $product = Product::find($id);
        return view('purchase',compact('product','profile'));
    }

    // public function charge(Request $request, Product $product)
    // {
    //     $user = Auth::user();

    //     $paymentMethod = $request->input('payment_method');
    //     $productId = $request->input('product_id');
    //     $product = Product::find($productId);

    //     if (!$product) {
    //         return redirect()->back()->withErrors(['product_id' => '指定された商品が見つかりません。']);
    //     }
    //     $order = Order::create([
    //         'user_id' => $user->id,
    //         'product_id' => $product->id,
    //         'payment_method' => $paymentMethod
    //     ]);

    //     Stripe::setApiKey('sk_test_51QMgs32Mh5gYIf3Nm9XgJYgjv5rZzE7v5xU19geQgelLQsbcxrtp1pwcED0p8KsbjiYkglhVz6y7HWex6YjMTULP00zUnPZeKK');
    //     $intent = null;
    //     if($paymentMethod == 'card'){

    //         $intent = PaymentIntent::create([
    //         'amount' => $product->price,
    //         'currency' => 'jpy',
    //         'payment_method_types' => ['card'],
    //     ]);
    //     } elseif ($paymentMethod == 'conbini') {

    //         $intent = PaymentIntent::create([
    //             'amount' => $product->price,
    //             'currency' => 'jpy',
    //             'payment_method_types' => ['conbini'],
    //         ]);
    // }

    // if ($intent) {
    //     return view('purchase', [
    //         'product' => $product,
    //         'order' => $order,
    //         'clientSecret' => $intent->client_secret,
    //     ]);
    // } else {
    //     return redirect()->back()->withErrors(['payment_method' => '無効な支払い方法です。']);
    // }}
}


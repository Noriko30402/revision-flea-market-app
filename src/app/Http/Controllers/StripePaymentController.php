<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\DB;





class StripePaymentController extends Controller
{

    public function  purchase($item_id){
        $user = Auth::user();
        $profile = $user->profile;

        $product = Product::find($item_id);
        return view('purchase',compact('product','profile'));
    }

    public function charge(PurchaseRequest $request, Product $product)
    {
        $user = Auth::user();
        $paymentMethod = $request->input('payment_method');
        $productId = $request->input('product_id');
        $product = Product::find($productId);

    Stripe::setApiKey(env('STRIPE_SECRET'));
        $line_items =[];

        if ($paymentMethod == 'card' || $paymentMethod == 'konbini') {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $product->product_name,
                    ],
                    'unit_amount' => $product->price ,
                ],
                'quantity' => 1,
            ];
        }

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card', 'konbini'],
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('checkout.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
            'cancel_url' => route('purchase'),
            'client_reference_id' => $product->id,
        ]);

        $user = Auth::user();
        $productId = $request->input('product_id');
        $paymentMethod = $request->input('payment_method');

        $order = Order::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'payment_method' => $paymentMethod
                ]);
        $product = DB::table('products')->where('id', $productId)->first();

                DB::table('products')
                ->where('id', $productId)
                ->update(
                [
                    'is_sold' => true,
                ]
                );

        return redirect($checkout_session->url);
    }


public function success()
{
    return view ('success');
}
}
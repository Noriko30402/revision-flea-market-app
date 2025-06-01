<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Order;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\DB;





class StripePaymentController extends Controller
{

    public function  purchase($item_id){
        $user = Auth::user();
        $profile = $user->profile;

        $item = Item::find($item_id);
        return view('purchase',compact('item','profile'));
    }

    public function charge(PurchaseRequest $request, Item $item)
    {
        $user = Auth::user();
        $paymentMethod = $request->input('payment_method');
        $itemId = $request->input('item_id');
        $item = Item::find($itemId);

    Stripe::setApiKey(env('STRIPE_SECRET'));
        $line_items =[];

        if ($paymentMethod == 'card' || $paymentMethod == 'konbini') {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->item_name,
                    ],
                    'unit_amount' => $item->price ,
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
            'client_reference_id' => $item->id,
        ]);

        $user = Auth::user();
        $itemId = $request->input('item_id');
        $paymentMethod = $request->input('payment_method');

        $order = Order::create([
                    'user_id' => $user->id,
                    'item_id' => $item->id,
                    'payment_method' => $paymentMethod,
                ]);
        $item = DB::table('items')->where('id', $itemId)->first();

                DB::table('items')
                ->where('id', $itemId)
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
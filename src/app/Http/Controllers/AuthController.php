<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function index(Request $request){

        $tab = $request->input('tab', 'sell');
        $user = Auth::user();
        $profile = $user->profile;
        $products = Product::where('user_id', $user->id)->get();
        $soldProducts = Product::where('is_sold', true)->get();
        $buyProducts = Order::with('product')
        ->where('user_id', $user->id)
        ->whereIn('product_id', $soldProducts->pluck('id'))
        ->get();
        return view('profile',compact('profile','buyProducts','products','tab'));
    }


    public function edit(Request $request){

    $user = Auth::user();
    $profile = $user->profile;

    return view('edit_profile',compact('profile'));
    }

    // プロフィール編集
    public function storeOrUpdate(ProfileRequest $request)
    {
        $user = Auth::user();
        $profile = $user->profile;
        if ($profile) {
            $profile->update([
                'name' => $request->name,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'building' => $request->building,
            ]);
        } else {
            $profile = new Profile();
            $profile->name = $request->name;
            $profile->postcode = $request->postcode;
            $profile->address = $request->address;
            $profile->building = $request->building;
            $profile->user_id = $user->id;
            $profile->save();
        }
        $image = $request -> file('image');
            if ($request->hasFile('image')){
            $path = \Storage::put('/public/images',$image);
            $path = explode('/',$path);
            $profile->image = $path[2];
        }else{
            $profile->image = $profile->image ?? 'default.jpg';
        }
        $profile->save();

        return redirect()->route('index');
    }

    public function addressIndex($id){
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }
        // $product = Product::find($item_id);
        $product = Product::find($id);

        $profile = $user->profile;
        return view('edit_address',compact('user','profile','product'));
    }


    public function update(AddressRequest $request,$id)
    {
        $user = Auth::user();
        $profile = $user->profile;
        $profile->update([
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
        ]);
        $profile->save();
        $product = Product::find($id);

        return view('purchase',compact('product','profile'));
    }

}

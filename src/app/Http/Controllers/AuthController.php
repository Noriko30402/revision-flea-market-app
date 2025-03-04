<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Item;
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
        $items = Item::where('user_id', $user->id)->get();
        $soldItems = Item::where('is_sold', true)->get();
        $buyItems = Order::with('item')
        ->where('user_id', $user->id)
        ->whereIn('item_id', $soldItems->pluck('id'))
        ->get();
        return view('profile',compact('profile','buyItems','items','tab'));
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

    public function addressIndex($item_id){
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }
        $item = Item::find($item_id);

        $profile = $user->profile;
        return view('edit_address',compact('user','profile','item'));
    }


    public function update(AddressRequest $request,$item_id)
    {
        $user = Auth::user();
        $profile = $user->profile;
        $profile->update([
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
        ]);
        $profile->save();
        $item = Item::find($item_id);

        return view('purchase',compact('item','profile'));
    }

}

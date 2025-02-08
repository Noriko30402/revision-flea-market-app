<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function index(){

    return view('profile');
}

public function edit(Request $request){

    $user = Auth::user();
    $profile = $user->profile;

    return view('edit_profile',compact('profile'));
}

    public function storeOrUpdate(AddressRequest $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        if ($profile) {
            $profile->update([
                'name' => $request->name,
                // 'image' => $request->image,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'building' => $request->building,
            ]);
        } else {
            $profile = new Profile();
            $profile->name = $request->name;
            // $profile->image = $request->image;
            $profile->postcode = $request->postcode;
            $profile->address = $request->address;
            $profile->building = $request->building;
            $profile->user_id = $user->id;
            $profile->save();
        }

        return redirect()->route('index');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        $profile->update([
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
        ]);

    return redirect()->route('index');


    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function index(){

    return view('index');
}

public function edit(){

    return view('edit_profile');
}

// public function images (Request $request)
// {
//     $profile = Auth::user()->profile ?? new Profile();
//     $profile->user_id = auth()->id();

//     if ($request->hasFile('image')) {
//         $profileImagePath = $request->file('image')->store('public/profiles');
//         $profile->image = $profileImagePath;
//     }

//     $profile->save();
//     return redirect()->route('mypage.profile');
// }

public function store(Request $request)
{
    $profile = new Profile();
    $profile->name = $request->name;
    // $profile->image =$request->image;
    $profile->postcode = $request->postcode;
    $profile->address = $request->address;
    $profile->building = $request->building;

    $profile->user_id = auth()->id();
    $profile->save();

    $user = Auth::user();
    $profile = $user->profile;

    return redirect()->route('index');
    // return view('index', compact('profile'));
}
}
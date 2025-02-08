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

    return view('profile');
}

public function edit(Request $request){

    $user = Auth::user();
    $profile = $user->profile;

    return view('edit_profile',compact('profile'));
}


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
}
}
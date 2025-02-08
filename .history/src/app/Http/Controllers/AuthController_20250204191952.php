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
    public function index(Request $request){

    $profile = $request->session()->get('profile',[]);

    return view('profile',compact('profile'));
}



public function edit(){

    return view('edit_profile');
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
    // return view('index', compact('profile'));
}
}
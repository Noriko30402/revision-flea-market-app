<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
    public function index(){

    return view('profile');
}

public function edit(Request $request){

    $user = Auth::user();
    $profile = $user->profile;
    $image = $request->file('image');
        if($request->hasFile('image')){
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
            $profile->image = $path[1];
        }else{
            $path = null;
            // if (!$profile->image) {
            //     $profile->image = 'default.jpg';  
            // }       
         }

    return view('edit_profile',compact('profile','image'));
}

    public function storeOrUpdate(AddressRequest $request)
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

        // $image = $request -> file('image');
        //     if ($request->hasFile('image')){
        //     $path = \Storage::put('/public/images',$image);
        //     $path = explode('/',$path);
        //     $profile->image = $path[1];
        // }else{
        //     $path = null;
        //     // $profile->image = 'default.jpg'; 
        // }
        // $profile->save();
        $image = $request->file('image');
            // 画像がアップロードされた場合、'public/profile_images' に保存
    if ($request->hasFile('image')) {
        // 画像を 'public/profile_images' フォルダに保存
        $path = $image->store('public/profile_images');
        // 保存されたパスからファイル名だけを取得
        $filename = basename($path);
        // プロフィール画像を新しいファイル名に更新
        $profile->image = $filename;
    } else {
        // 画像がアップロードされていない場合、既存の画像をそのまま使うか、デフォルト画像に設定
        $profile->image = $profile->image ?? 'default.jpg';
    }

        return redirect()->route('index');
    }

    

    public function addressIndex(){
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $profile = $user->profile;
        return view('edit_address',compact('user','profile'));
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

        return redirect()->route('purchase', ['id' => $user->id]);
        }
}

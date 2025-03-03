<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Category;
use App\Models\Condition;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Handler\Proxy;
use App\Models\Comment;
use App\Http\Requests\ExhibitionRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CommentRequest;


use function PHPSTORM_META\elementType;

class ItemController extends Controller
{
    public function index(Request $request){

        $tab = $request->input('tab', 'recommendations');
        $user = Auth::user();
    if($user){
        $products = Product::where('user_id', '!=', $user->id)
        ->orWhereNull('user_id')
        ->get();
        $favorites = collect();
        if ($user) {
        $favorites = $user->favorites;
        }
    } else{
        $favorites = collect();
        $products =  Product::all();
    }
        return view('index',compact('products','favorites','tab'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $tab = $request->input('tab', 'recommendations');
        $products = Product::where('product_name', 'LIKE', '%' . $query . '%')->get();
        $user = Auth::user();
        return view('index', compact('products','tab'));
    }


    public function show($id){
        $product = Product::find($id);
        $product = Product::with('categories')->find($id);
        $condition = Condition::find($product->condition_id);

        return view('item',compact('product','condition'));
    }

    public function favorite(Product $product)
    {
        $user = Auth::user();
        $product->favorites()->attach($user->id);

        return redirect()->back();
    }

    public function unfavorite(Product $product)
    {
        $user = Auth::user();
        $product->favorites()->detach(Auth::id());
        return redirect()->back();
    }


    public function storeComment(CommentRequest $request, Product $product)
    {
        Comment::create([
            'product_id' => $product ->id,
            'user_id' => Auth::id(),
            'content' => $request ->content,
        ]);

        return redirect()->route('item.show',$product->id);
    }


    public function showSellForm(){
        $conditions = Condition::all();

        return   view('sell',compact('conditions'));
    }

    public function storeSellForm(ExhibitionRequest $request){
        $user = Auth::user();
        $product = Product::create([
            'user_id' => $user->id,
            'condition_id' => $request->condition_id,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request -> image,
            'brand' => $request ->brand,
        ]);
        $product->categories()->attach($request->input('category'));

        $image = $request -> file('image');
        if ($request->hasFile('image')){
        $path = \Storage::put('/public/product_images',$image);
        $path = explode('/',$path);
        $product->image = $path[2];
        }else{
        $path = null;
        }
        $product->save();

        return redirect()->route('index');
    }
}


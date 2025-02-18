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

use function PHPSTORM_META\elementType;

class ItemController extends Controller
{
    public function index(){
        $products = Product::all();
        $user = Auth::user();
        $favorites = collect();

        if ($user) {
        $favorites = $user->favorites;
        }

        return view('index',compact('products','favorites'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('product_name', 'LIKE', '%' . $query . '%')->get();

        $user = Auth::user();
        if ($user) {
            $favoriteProductIds = $user->favorites->pluck('product_id');
            $favorites = Product::whereIn('id', $favoriteProductIds)->where('product_name', 'LIKE', '%' . $query . '%')->get();
        } else {
            $favorites = collect();
        }
        return view('index', compact('products','favorites'));
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


    public function storeComment(Request $request, Product $product)
    {
        $request ->validate([
            'content' => 'required|max:255'
        ]);

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
        ]);
        $product->categories()->attach($request->input('category_id'));

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


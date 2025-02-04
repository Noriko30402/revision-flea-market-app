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

        return view('index',compact('products'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', '%' . $query . '%')->get();
        return view('index', compact('products'));
    }


    public function show($id){
        $product = Product::find($id);
        $product = Product::with('categories')->find($id);
        if (!$product) {
        abort(404);
        }
        $condition = Condition::find($product->condition_id);
        return view('item',compact('product','condition'));
        }

    // public function toggleFavorite(Product $product)
    // {

    //     if (!auth()->check()){
    //         return redirect()->route('login');
    //     }
    //     $user = Auth::user();
    //     $favorite = $product -> favorites()->where('user_id',$user->id);
    //     if ($favorite ->exists()){
    //         $favorite ->delete();
    //     }else{
    //         $product -> favorites()->create(['user_id'=> $user ->id]);
    //     }
    //     return redirect()->back();
    // }

    public function favorite(Product $product)
    {
        $user = Auth::user();
        // if (!$product->users()->where('user_id', $user->id)->exists()) {
        //     $product->users()->attach($user->id);
        // }      
        if (!$product->favorites()->where('user_id', $user->id)->exists()) {
            $product->favorites()->attach($user->id);
        }      

        return redirect()->back(); 
        //  return redirect()->route('item.show');
    }

    public function unfavorite(Product $product)
    {
        // $product->users()->detach(Auth::id());
        $user = Auth::user();

        if ($product->favorites()->where('user_id', $user->id)->exists()) {
        $product->favorites()->detach(Auth::id());
        }
        return redirect()->back();
        // return redirect()->route('item.show');

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
        $product = Product::create($request->only(['condition_id','product_name', 'description', 'price']));
        $product->categories()->attach($request->input('category_id'));
        return redirect()->route('index');
    }
}
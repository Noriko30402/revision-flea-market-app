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

use function PHPSTORM_META\elementType;

class ItemController extends Controller
{
    public function index(){
        $products = Product::all();

        return view('index',compact('products'));

        // $user = User::find(auth()->id());
        // return view('index',compact('products','user'));
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
        //     $user = Auth::user();
        //     if (!$user) {
        //         return back()->withErrors(['error' => 'ユーザーが認証されていません。']);
        //     }
        //     $favorite = $product->favorites()->where('user_id', $user->id)->first();
        
        //     if ($favorite) {
        //         $favorite->delete();
        //     } else {
        //         $product->favorites()->create(['user_id' => $user->id]);
        //     }
        
        //     return redirect()->back();
        // }
        
    public function togglefavorite(Product $product)
    {
        public function toggleFavorite(Product $product)
        {
            if (!auth()->check()) {
                return redirect()->route('login');
            }
        
            $user = auth()->user();
            $favorite = $user->favorites()->where('product_id', $product->id)->first();
        
            if ($favorite) {
                $user->favorites()->detach($product->id);
            } else {
                $user->favorites()->attach($product->id);
            }
        
            return redirect()->back();
        }
        
        // if (!auth()->check()){
        //     return redirect()->route('login');
        // }
        // $user = Auth::user();
        // $favorite = $product -> favorites()->where('user_id',$user->id);

        // if ($favorite ->exists()){
        //     $favorite ->delete();
        // }else{
        //     $product -> favorites()->create(['user_id'=> $user ->id]);
        // }

        // return redirect()->back();
    }

    public function store(Request $request, Product $product) 
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
        // public function store(Request $request,$id)
        // {
        //     $data = $request->all();
        //     $product_id = $data['product_id'];

        //     Comment::create([
        //         'content' => $data['content'],
        //         'product_id' => $product_id,
        //         'user_id' => Auth::id(),
        //     ]);

        //     $product = Product::find($id);
        //     $product = Product::with('categories')->find($id);
        //     if (!$product) {
        //     abort(404);
        //     }
        //     $condition = Condition::find($product->condition_id);

        //     return view('item', compact('product', 'condition'));
        // }



}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Condition;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Http\Requests\ExhibitionRequest;
use App\Http\Requests\CommentRequest;
use App\Models\Category;
use Storage;
use App\Models\Favorite;


class ItemController extends Controller
{
public function index(Request $request)
{
    $tab = $request->input('tab', 'recommendations');
    $user = Auth::user();

    if ($user) {
        $items = Item::where('user_id', '!=', $user->id)
                    ->orWhereNull('user_id')
                    ->get();
        $favorite_items = $user->favorites;
    } else {
        $items = Item::all();
        $favorite_items = collect();
    }

    return view('index', compact('items', 'favorite_items', 'tab'));
}


    public function search(Request $request)
    {
        $query = $request->input('query');
        $tab = $request->input('tab', 'recommendations');
        $items = Item::where('item_name', 'LIKE', '%' . $query . '%')->get();
        $user = Auth::user();
        if ($user) {
            $favorites = $user->favorites;
            $favorite_items = Item::whereIn('id', $favorites->pluck('id'))
                            ->where('item_name', 'LIKE', '%' . $query . '%')
                            ->get();
        }
        return view('index', compact('items','tab','favorites','favorite_items'));
    }


    public function show($item_id){
        $item = Item::find($item_id);
        $item = Item::with('categories')->find($item_id);
        $condition = Condition::find($item->condition_id);

        return view('item',compact('item','condition'));
    }

    public function favorite(Item $item)
    {
        $user = Auth::user();
        $item->favorites()->attach($user->id);

        return redirect()->back();
    }

    public function unfavorite(Item $item)
    {
        $user = Auth::user();
        $item->favorites()->detach(Auth::id());
        return redirect()->back();
    }


    public function storeComment(CommentRequest $request, Item $item)
    {
        Comment::create([
            'item_id' => $item ->id,
            'user_id' => Auth::id(),
            'content' => $request ->content,
        ]);

        return redirect()->route('item.show',$item->id);
    }


    public function showSellForm(){
        $conditions = Condition::all();
        $categories = Category::all();

        return   view('sell',compact('conditions','categories'));
    }

    public function storeSellForm(ExhibitionRequest $request){

        $user = Auth::user();
        $item = Item::create([
            'user_id' => $user->id,
            'condition_id' => $request->condition_id,
            'item_name' => $request->item_name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request -> image,
            'brand' => $request ->brand,
        ]);
        $item->categories()->sync($request->input('categories'));
        $image = $request -> file('image');
        if ($request->hasFile('image')){
        $path = \Storage::put('/public/product_images',$image);
        $path = explode('/',$path);
        $item->image = $path[2];
        }else{
        $path = null;
        }
        $item->save();

        return redirect()->route('index');
    }
}


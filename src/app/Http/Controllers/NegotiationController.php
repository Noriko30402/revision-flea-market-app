<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;



class NegotiationController extends Controller
{
    public function index($item_id,$partnerId)
    {

        $item = Item::find($item_id);
        // $userId = Auth::id();

        // $messages = Message::where(function ($q) use ($userId, $partnerId) {
        //         $q->where('sender_id', $userId)->where('receiver_id', $partnerId);
        //         })->orWhere(function ($q) use ($userId, $partnerId) {
        //         $q->where('sender_id', $partnerId)->where('receiver_id', $userId);
        // })

    $userId = auth()->id();

    $messages = Message::where('item_id', $item_id)
        ->where(function ($query) use ($userId, $partnerId) {
            $query->where(function ($q) use ($userId, $partnerId) {
                $q->where('sender_id', $userId)->where('receiver_id', $partnerId);
            })->orWhere(function ($q) use ($userId, $partnerId) {
                $q->where('sender_id', $partnerId)->where('receiver_id', $userId);
            });
        })
        ->orderBy('created_at')
        ->get();

        return view('negotiation',compact('item','messages', 'partnerId'));
    }

    public function store(Request $request)
    {
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
            'item_id' => $request->input('item_id'),
        ]);
        return redirect()->back();
    }
}

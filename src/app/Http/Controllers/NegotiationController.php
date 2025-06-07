<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Profile;
use App\Models\Order;
use App\Models\Message;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NegotiationRequest;
use App\Notifications\NewChatMessage;




class NegotiationController extends Controller
{
    public function index($item_id, $orderId, Request $request)
    {

         $user = auth()->user();

    // ここで該当する通知のみ既読にする
$user->unreadNotifications()
    ->where('type', \App\Notifications\NewChatMessage::class)
    ->whereJsonContains('data->order_id', $orderId)
    ->get()
    ->each
    ->markAsRead();

    
        $item = Item::find($item_id);
        $userId = auth()->id();
        $order = Order::findOrFail($orderId);
        $soldItems = Item::where('is_sold', true)->get();

        if ($userId == $item->user_id) {
            $partnerId = $order->user_id;
        } else {
            $partnerId = $item->user_id;
        }

        $partner = \App\Models\User::find($partnerId);
        $profileName = $partner ? $partner->profile->name : null;

        $messages = Message::where('order_id', $orderId)
                        ->orderBy('created_at')
                        ->get();
        $editId = $request->query('edit');

        $negotiationItems = Order::with('item')
            ->where(function ($query) use ($userId, $soldItems) {
            $query->where('user_id', $userId)
            ->whereIn('item_id', $soldItems->pluck('id'));
            })
            ->orWhereHas('item', function ($query) use ($userId, $soldItems) {
            $query->where('user_id', $userId)
            ->whereIn('id', $soldItems->pluck('id'));
            })
            ->get();

        $content = $request->session()->get('content', []);

        return view('negotiation',compact('item','messages', 'partnerId','orderId',
                                    'editId','negotiationItems','profileName','userId'));
    }

    public function store(NegotiationRequest $request)
    {
        $imageName = null;
        if ($request->hasFile('img_url')) {
            $image = $request->file('img_url');
            $path = \Storage::put('public/negotiation_images', $image);
            $pathParts = explode('/', $path);
            $imageName = end($pathParts);
        }

        $message =Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
            'item_id' => $request->input('item_id'),
            'order_id' => $request->order_id,
            'image' => $imageName,
        ]);

        $receiver = \App\Models\User::find($request->receiver_id);

        if ($receiver) {
        $receiver->notify(new NewChatMessage($message));
        }
        return redirect()->back();
    }


    public function destroy(Request $request)
    {
        Message::find($request->id)->delete();
        return redirect()->back();
    }

    public function update(NegotiationRequest $request, $id)
    {
    $message = Message::findOrFail($id);

    if ($message->sender_id !== auth()->id()) {
        abort(403);
    }

    $message->content = $request->input('content');
    $message->save();

    return redirect()->route('negotiation.index', [
        'item_id' => $message->item_id,
        'orderId' => $message->order_id,
        ]);
    }
public function review(Request $request)
{
    Review::create([
        'order_id' => $request->order_id,
        'receiver_id' => $request->receiver_id,
        'sender_id' => Auth::id(),
        'stars' => $request->stars,
    ]);

    return redirect()->route('index');
    }
}


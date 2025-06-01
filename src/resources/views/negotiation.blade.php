@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css')}}">
@endsection

@section('content')
<div class="container">

  <div class="product-box">
    <h1 class="item-name">{{ $item->item_name }}</h1>
    <img class="item-image" src="{{ asset('storage/product_images/' . $item->image) }}" alt="{{ $item->item_name }}">
    <p class="item-price">¥{{ number_format($item->price) }}(税込)</p>
  </div>

  <div class="message-box">
    @foreach($messages as $message)
      <div>
        <p class="name">{{ $message->sender->name }}:</p>
        <p class="message"> {{ $message->content }}</p>
      </div>
    @endforeach

    <form method="POST" action="{{ route('chat.send') }}">
      @csrf
      <input type="hidden" name="receiver_id" value="{{ $partnerId }}">
      <input type="hidden" name="item_id" value="{{ $item->id }}">
      <textarea name="content" required></textarea>
      <button type="submit">送信</button>
  </form>

  </div>
</div>
@endsection



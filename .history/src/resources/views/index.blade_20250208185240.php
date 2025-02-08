@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
<div class="container">

    <div id="recommendations">
      <div id="favorites">

      <ul id="tab">
        <li class="tab-recommendation"><a href="#recommendations">おすすめ</a></li>
        <li class="tab-favorites"><a href="#favorites">マイリスト</a></li>
      </ul>

      <div class="contents">

        <div class="recommendations">
            <ul class="product-container">
            @foreach($products as $product)
            <li class="product-item">
              <a href="{{ route('item.show', $product->id) }}">
                <img class="product-image" src="{{ $product->image }}" alt="{{ $product->name }}">
                <h3 class="product-name">{{ $product->product_name }}</h3>
              </a>
            </li>
              @endforeach
            </ul>
        </div>


        <div class="favorites">
          <ul class="product-container">
            @if($favorites->isEmpty())
              <p>お気に入りの商品がありません。</p>

            @else
              @foreach($favorites as $favorite)
              <li class="product-item">
                  <img class="product-image" src="{{ $favorite->image }}" alt="{{ $favorite->name }}">
                  <h3 class="product-name">{{ $favorite->product_name }}</h3>
                </a>
              </li>
                @endforeach
            @endif
      </div>
</form>
@endsection
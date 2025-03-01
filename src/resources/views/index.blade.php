@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
<div class="container">

<div class="contents">
  <ul class="tabs">
    <li><a href="{{ route('index', ['tab' => 'recommendations']) }}" class="{{ request('tab') == 'recommendations' ? 'active' : '' }}">おすすめ</a></li>
    <li><a href="{{ route('index', ['tab' => 'mylist']) }}" class="{{ request('tab') == 'mylist' ? 'active' : '' }}">マイリスト</a></li>
  </ul>

  <div class="tab-content">
    @if($tab == 'recommendations')
        <ul class="product-container">
          @foreach($products as $product)
            <li class="product-item">
              <a href="{{ route('item.show', $product->id) }}">

                @if ($product->image && \Storage::exists('public/product_images/' . $product->image))
                  <img class="product-image" src="{{ asset('storage/product_images/' . $product->image) }}" alt="{{ $product->product_name }}">
                @elseif ($product->image)
                  <img class="product-image" src="{{ $product->image }}" alt="{{ $product->product_name }}">
                @else
                  <img class="product-image" src="{{ asset('storage/images/default.jpg') }}" alt="{{ $product->product_name }}">
                @endif

                @if ($product ->is_sold == true)
                  <h3 class="product-name">{{ $product->product_name}} <span style="color: red;"> < Sold ></h3>
                @else
                  <h3 class="product-name">{{ $product->product_name }}</h3>
                @endif
              </a>
            </li>
          @endforeach
        </ul>

    @elseif($tab == 'mylist')
        <ul class="product-container">
          @if($favorites->isEmpty())
            <p>お気に入りの商品がありません。</p>

          @else
            @foreach($favorites as $favorite)
              <li class="product-item">
                <a href="{{ route('item.show', $favorite->id) }}">
                  @if ($favorite->image && \Storage::exists('public/product_images/' . $favorite->image))
                    <img class="product-image" src="{{ asset('storage/product_images/' . $favorite->image) }}" alt="{{ $favorite->product_name }}">
                  @elseif ($favorite->image)
                    <img class="product-image" src="{{ $favorite->image }}" alt="{{ $favorite->product_name }}">
                  @else
                    <img class="product-image" src="{{ asset('storage/images/default.jpg') }}" alt="{{ $favorite->product_name }}">
                  @endif

                  @if ($favorite ->is_sold == true)
                    <h3 class="product-name">{{ $favorite->product_name}} <span style="color: red;"> < Sold ></h3>
                  @else
                    <h3 class="product-name">{{ $favorite->product_name }}</h3>
                @endif

                </a>
              </li>
            @endforeach
          @endif
        </ul>
    @endif
  </div>
@endsection
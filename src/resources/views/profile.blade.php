@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css')}}">
@endsection

@section('content')
<div class="container">

    <form action="{{ route('mypage.profile') }}" method="GET">
      <div class="profile-heading">
        <img src="{{ asset('storage/images/' . ($profile->image ?? 'default.jpg')) }}" class="profile-img" />
        <input type="text" class="user_name" name="name" value="{{$profile->name?? '' }}">
        <button type="submit" class="profile-button">プロフィールを編集</button>
      </div>
    </form>

  <div class="contents">
    <ul class="tabs">
      <li><a href="{{ route('mypage', ['tab' => 'sell']) }}" class="{{ request('tab') == 'sell' ? 'active' : '' }}">出品した商品</a></li>
      <li><a href="{{ route('mypage', ['tab' => 'buy']) }}" class="{{ request('tab') == 'buy' ? 'active' : '' }}">購入した商品</a></li>
    </ul>

    <div class="tab-content">
      @if($tab == 'sell')
        <div class="sell-tab">
          @if($products->isEmpty())
            <p>出品した製品がありません。</p>
          @else
            @foreach($products as $product)
              <li class="product-item">
                <a href="{{ route('item.show', $product->id) }}">
                  <img class="product-image" src="{{ asset('storage/product_images/' . $product->image) }}" alt="{{ $product->product_name }}">
                  <h3 class="product-name">{{ $product->product_name }}</h3>
                </a>
              </li>
            @endforeach
          @endif
        </div>

      @elseif($tab == 'buy')
        <div class="buy-tab">
          @if ($buyProducts->isEmpty())
            <p>購入した商品がありません。</p>
          @else
            @foreach ( $buyProducts as  $buyProduct)
              <li class="product-item">
                <a href="{{ route('item.show' ,$buyProduct->product_id)}}">
                  <img class="product-image" src="{{ $buyProduct->product->image }}" alt="{{ $buyProduct->name }}">
                  <h3 class="product-name">{{ $buyProduct->product->product_name }}</h3>
                </a>
              </li>
            @endforeach
          @endif
      @endif
    </div>
  </div>

      {{-- <div class="contents">
        <div class="sell-products">
            <ul class="sell-container">
                @if($products->isEmpty())
                  <p>出品した製品がありません。</p>
                @else
                    @foreach($products as $product)
                        <li class="product-item">
                          <a href="{{ route('item.show', $product->id) }}">
                            <img class="product-image" src="{{ asset('storage/product_images/' . $product->image) }}" alt="{{ $product->product_name }}">
                            <h3 class="product-name">{{ $product->product_name }}</h3>
                          </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="buy-products">
          <ul class="buy_container">
            @if ($buyProducts->isEmpty())
                <p>購入した商品がありません。</p>
            @else
                @foreach ( $buyProducts as  $buyProduct)
                    <li class="product-item">
                      <a href="{{ route('item.show' ,$buyProduct->product_id)}}">
                        <img class="product-image" src="{{ $buyProduct->product->image }}" alt="{{ $buyProduct->name }}">
                        <h3 class="product-name">{{ $buyProduct->product->product_name }}</h3>
                      </a>
                    </li>
                @endforeach
            @endif
          </ul>

        </div>
        </div>  --}}

@endsection
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

    <div id="sell-products">
      <div id="buy-products">

      <ul id="tab">
        <li class="tab-sell-products"><a href="#sell-products">出品した商品</a></li>
        <li class="tab-buy-products"><a href="#buy-products">購入した商品</a></li>
      </ul>

      <div class="contents">

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
        <section>

          <h1>XHTML</h1>
          <p>...省略...</p>

        </section>
        </div>
        </div>
</form>
@endsection
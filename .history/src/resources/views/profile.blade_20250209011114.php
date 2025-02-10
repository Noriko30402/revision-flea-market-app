@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css')}}">
@endsection

@section('content')
<div class="container">

  <div class="profile-heading">
    <h1>ユーザー名</h1>
    <form action="{{ route('profile.storeOrUpdate') }}" method="GET">
      <button type="submit" class="btn btn-primary">プロフィールを編集</button>
  </form>
    </div>
    <div id="sell-products">
      <div id="buy-products">

      <ul id="tab">
        <li class="tab-sell-products"><a href="#sell-products">出品した商品</a></li>
        <li class="tab-buy-products"><a href="#buy-products">購入した商品</a></li>
      </ul>

      <div class="contents">

        <div class="sell-products">
            <ul class="sell-container">
            {{-- @foreach($products as $product)
            <li class="sell-item">
              <a href="{{ route('item.show', $product->id) }}">
                <img class="sell-image" src="{{ $product->image }}" alt="{{ $product->name }}">
                <h3 class="sell-name">{{ $product->name }}</h3>
              </a>
            </li>
              @endforeach --}}
            </ul>
        </div>


        <div class="buy-products">
        <section>
        {{-- <form action="{{ route('item.show', ['id' => $user->id]) }}"  method="get" class="form"> --}}
          {{-- <form action="{{ route('item.show')}}"  method="get" class="form"> --}}

          <h1>XHTML</h1>
          <p>...省略...</p>

        </section>
        </div>
        </div>
</form>
@endsection
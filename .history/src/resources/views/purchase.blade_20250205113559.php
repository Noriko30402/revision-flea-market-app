@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/buy.css')}}">
@endsection

@section('content')
<div class="container">
  <div class="product-image">
    <img src="{{ $product->image }}" alt="{{ $product->name }}">
  </div>

  <div class="product-detail">
    <h1 class="product-name">{{ $product->product_name }}</h1>
    <p class="product-price">¥{{ number_format($product->price) }}(税込)</p>

    <h2>支払い方法</h2>
    <select name="payment-method" class="select-payment-method">
      <option value="" disabled selected>選択してください</option>
      <option value="convenience_store">コンビニ支払い</option>
      <option value="credit_card">カード払い</option>
    </select>

    <h2>配送先</h2>
    <a href="{{ route('mypage.profile') }}">変更する</a>
    <p class="postcode">{{ $profile->postcode }}</p>
      <p class="address">{{ $profile->address }}</p>
      <p class="building">{{ $profile->building }}</p>

    <h3>商品代金</h3>
    <p class="product-price">¥{{ number_format($product->price) }}</p>
@endsection



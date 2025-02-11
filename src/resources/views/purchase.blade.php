@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/buy.css')}}">
@endsection

@section('content')
<div class="container">
  <div class="product-image">
    <img src="{{ $product->image}}" alt="{{ $product->name}}">
    <p class="product-price">¥{{ number_format($product->price) }}</p>

  </div>

  <div class="product-detail">
    <h1 class="product-name">{{ $product->product_name }}</h1>

    <form>
    <h2>支払い方法</h2>
    {{-- <select name="payment-method" class="select-payment-method" > --}}
      <select id="payment_method" name="payment_method" onchange="displaySelection()">
      <option value="" disabled selected>選択してください</option>
      <option value="コンビニ支払い">コンビニ支払い</option>
      <option value="カード払い">カード払い</option>
    </select>
  </form>
    <h2>配送先</h2>
    <a href="{{ route('addressIndex') }}">変更する</a>
    <p class="postcode">{{ $profile->postcode }}</p>
      <p class="address">{{ $profile->address }}</p>
      <p class="building">{{ $profile->building }}</p>

    <h3>商品代金</h3>
    <p class="product-price">¥{{ number_format($product->price) }}</p>
    <div id="display_area"></div>

    <script>
      function displaySelection() {
          var selectedMethod = document.getElementById("payment_method").value;
          document.getElementById("display_area").innerText = "選択された支払い方法: " + selectedMethod;
      }
  </script>
    
@endsection



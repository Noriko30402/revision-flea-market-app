@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css')}}">
@endsection

@section('content')
<div class="container">

  <div class="product-container">
      <div class="product-title">
        <img class="product-image" src="{{ $product->image}}" alt="{{ $product->name}}">
        <div class="name-price">
          <h1 class="product-name">{{ $product->product_name }}</h1>
          <p class="product-price">¥{{ number_format($product->price) }}</p>
        </div>
      </div>
      <form action="{{ route('charge', $product->id) }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

      <div class="product-detail">
        <div class="payment-select">
          <h2>支払い方法</h2>
            <select id="payment_method" name="payment_method" onchange="displaySelection()">
              <option value="" disabled selected>選択してください</option>
              <option value="konbini">コンビニ支払い</option>
              <option value="card">カード払い</option>
            </select>
        </div>

        <div class="deliver-select">
          <div class="deliver-title">
            <h2>配送先</h2>
            <a  href="{{ route('addressIndex', $product->id) }}">変更する</a>
          </div>
          <div class="address-box">
            <p>〒{{ $profile->postcode }}</p>
            <p>{{ $profile->address }}{{ $profile->building }}</p>
          </div>
        </div>
      </div>
  </div>

  <div class="order-box">
    <div class="price-box">
      <h3 class="order-title">商品代金</h3>
      <p class="product-price">¥{{ number_format($product->price) }}</p>
    </div>
    <div class="deliver-box">
      <h3>支払い方法</h3>
      <div class="delivery-way" id="display_area"></div>
    </div>
      <button type="submit" class="purchase-button" >購入する</button>
  </div>

  </form>
</div>


      <script>
        function displaySelection() {
          var selectedMethod = document.getElementById("payment_method").value;
          var displayText = '';

            if (selectedMethod === 'konbini') {
                displayText = 'コンビニ支払い';
            } else if (selectedMethod === 'card') {
                displayText = 'カード払い';
            } else {
                displayText = '選択してください';
            }

            document.getElementById("display_area").innerText = displayText;
      }
      </script>
@endsection



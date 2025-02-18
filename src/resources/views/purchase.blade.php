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
        {{-- <input type="hidden" id="payment_method_input" name="payment_method" value=""> --}}
        <input type="hidden" name="amount" value="{{ $product->price * 100 }}">

      <div class="product-detail">
        <div class="payment-select">
          <h2>支払い方法</h2>
            <select id="payment_method" name="payment_method" onchange="displaySelection()">
              <option value="" disabled selected>選択してください</option>
              <option value="conbini">コンビニ支払い</option>
              <option value="card">カード払い</option>
            </select>
        </div>

        <div class="deliver-select">
          <div class="deliver-title">
            <h2>配送先</h2>
            <a  href="{{ route('addressIndex') }}">変更する</a>
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


    {{-- <button type="submit" class="purchase-button">購入する</button> --}}
    </form>
  </div>
</div>


      <script>
        function displaySelection() {
          var selectedMethod = document.getElementById("payment_method").value;
          var displayText = '';

            if (selectedMethod === 'conbini') {
                displayText = 'コンビニ支払い';
            } else if (selectedMethod === 'card') {
                displayText = 'カード払い';
            } else {
                displayText = '選択してください';
            }

            document.getElementById("display_area").innerText = displayText;
      }
      </script>


    {{-- <script>
      function displaySelection() {
          var selectedMethod = document.getElementById("payment_method").value;
          var displayText = '';

            if (selectedMethod === 'conbini') {
                displayText = 'コンビニ支払い';
            } else if (selectedMethod === 'card') {
                displayText = 'カード払い';
            } else {
                displayText = '選択してください';
            }

            document.getElementById("display_area").innerText = displayText;
      }

      var stripe = Stripe('{{ env('pk_test_51QMgs32Mh5gYIf3NbWZaIN0vgJfPjFU7YZvSombwidJnBPZZNOzFsIYj') }}');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        document.getElementById('payment-method').addEventListener('change', function(event) {
            if (event.target.value === 'card') {
                document.getElementById('card-element').style.display = 'block';
            } else {
                document.getElementById('card-element').style.display = 'none';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            if (document.getElementById('payment-method').value === 'card') {
                const { paymentMethod, error } = await stripe.createPaymentMethod('card', card);

                if (error) {
                    console.error(error);
                } else {
                    form.appendChild(
                        new hiddenInput('stripeToken', paymentMethod.id)
                    );
                    form.submit();
                }
            } else {
                form.submit();
            }
        });

        function hiddenInput(name, value) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = name;
            input.value = value;
            return input;
        }
  </script> --}}

@endsection



@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/purchase.css')}}">
@section('content')
    <div class="thanks-box">
        <h1 class="thanks-message">ご注文ありがとうございます！</h3>

        <p>商品が到着するまでしばらくお待ち下さい。</p>

            <a href="{{ url('/') }}" >トップページへ</a>
    </div>
@endsection

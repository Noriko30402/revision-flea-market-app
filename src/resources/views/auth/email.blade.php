@extends('layouts.app')

@section('css')
{{-- <link rel="stylesheet" href="{{ }}"> --}}
@endsection

@section('content')

<h1>メールアドレス認証</h1>
    <p>下のリンクをクリックして、メールアドレスを確認してください。</p>
    <a href="{{ $verificationUrl }}">メールアドレスを確認する</a>

@endsection

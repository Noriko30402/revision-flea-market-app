@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css')}}">
@endsection

@section('content')
<div class="container">
  <div class="main-title">
    <h1>商品の出品</h1>
      <form method="" action="{{ route('sell') }}" class="" enctype="multipart/form-data">
      @csrf

{{-- 商品画像 --}}
    <div class="image-box">
      <div class="form__group-title">
        <span class="form__label--item">商品画像</span>
      </div>
          {{-- <input type="file" name="item-image" class="image" accept="image/png,image/jpeg,image/gif"/> --}}
            <button>画像を選択する</button>
                {{-- <img src="/images/item-image-default.png"> --}}
        {{-- @error('item-image')
          <div style="color: #E4342E;" role="alert">
            <strong>{{ $message }}</strong>
          </div>
        @enderror --}}
    </div>

  <div class="item-detail">
    <h2 class="title">商品の詳細</h2>

    <div class="form__group-title">
      <span class="form__label--item">カテゴリー</span>
    </div>

    {{-- <label> <input type="radio" name="gender" value="1" {{ old('gender', $contact['gender'] ?? '') == '1' ? 'checked' : '' }}> 男</label> --}}
    {{-- <label>
      <input type="checkbox" name="options[]" value="option1"> オプション1
  </label> --}}
    <label> <input type="checkbox" name="category" value="1" {{ }}>ファッション</label>
    <label> <input type="checkbox" name="category" value="2" {{ }}>家電</label>
    <label> <input type="checkbox" name="category" value="3" {{ }}>インテリア</label>
    <label> <input type="checkbox" name="category" value="4" {{ }}>レディース</label>
    <label> <input type="checkbox" name="category" value="5" {{ }}>メンズ</label>
    <label> <input type="checkbox" name="category" value="6" {{ }}>コスメ</label>
    <label> <input type="checkbox" name="category" value="7" {{ }}>本</label>
    <label> <input type="checkbox" name="category" value="8" {{ }}>ゲーム</label>
    <label> <input type="checkbox" name="category" value="9" {{ }}>スポーツ</label>
    <label> <input type="checkbox" name="category" value="10" {{ }}>キッチン</label>
    <label> <input type="checkbox" name="category" value="11" {{ }}>ハンドメイド</label>
    <label> <input type="checkbox" name="category" value="12" {{ }}>アクセサリー</label>
    <label> <input type="checkbox" name="category" value="13" {{ }}>おもちゃ</label>
    <label> <input type="checkbox" name="category" value="14" {{ }}>ベビー・キッズ</label>
  
          @error('category')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
    </div>

    <div class="form__group-title">
      <span class="form__label--item">商品の状態</span>
    </div>
          <div class="form__input--select">
            <select name="condition_id">
              <option value="">選択してください</option>
              @foreach ($conditions as $condition)
              <option value="{{ $condition->id }}" {{ old('condition_id') == $condition->id ? 'selected' : '' }}> {{$condition->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form__error">
            @error('condition_id')
            {{ $message }}
            @enderror
          </div>
  </div>

  <div class="item-detail">
    <h2 class="title">商品名と説明</h2>
  {{-- 商品名 --}}
      <div class="item-name">
        <label for="name">商品名</label>
          <input id="name" type="text" class="name" value="{{ old('name') }}">

            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
      </div>

  {{-- 商品の説明 --}}
      <div class="item-description">
        <label for="description">商品の説明</label>
          <textarea id="description" class="description" name="description">{{ old('description') }}</textarea>

            @error('description')
              <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
              </span>
            @enderror
      </div>

  {{-- 販売価格 --}}
      <div class="item-price">
        <label for="price">販売価格</label>
          <input id="price" type="number" class="" name="price" placeholder="¥" value="{{ old('price') }}">

            @error('price')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
      </div>

      <div class="sell">
        <button type="submit" class="sell-button">
            出品する
        </button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

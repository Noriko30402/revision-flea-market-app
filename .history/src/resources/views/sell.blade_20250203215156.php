@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css')}}">
@endsection

@section('content')
<div class="container">
  <div class="main-title">
    <h1>商品の出品</h1>
      <form method="post" action="{{ route('store.sell') }}" class="">
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

    <input type="checkbox" id="category1" class="checkbox" name="category" value="1">
      <label for="category1" class="category-label">ファッション</label>
    <input type="checkbox" id="category2" class="checkbox" name="category" value="2">
      <label for="category2" class="category-label">家電</label>
    <input type="checkbox" id="category3" class="checkbox" name="category" value="3">
      <label for="category3" class="category-label">インテリア</label>
    <input type="checkbox" id="category4" class="checkbox" name="category" value="4">
      <label for="category4" class="category-label">レディース</label>
    <input type="checkbox" id="category5" class="checkbox" name="category" value="5">
      <label for="category5" class="category-label">メンズ</label>
    <input type="checkbox" id="category6" class="checkbox" name="category" value="6">
      <label for="category6" class="category-label">コスメ</label>
    <input type="checkbox" id="category7" class="checkbox" name="category" value="7">
      <label for="category7" class="category-label">本</label>
    <input type="checkbox" id="category8" class="checkbox" name="category" value="8">
      <label for="category8" class="category-label">ゲーム</label>
    <input type="checkbox" id="category9" class="checkbox" name="category" value="9">
      <label for="category9" class="category-label">スポーツ</label>
    <input type="checkbox" id="category10" class="checkbox" name="category" value="10">
      <label for="category10" class="category-label">キッチン</label>
    <input type="checkbox" id="category11" class="checkbox" name="category" value="11">
      <label for="category11" class="category-label">ハンドメイド</label>
    <input type="checkbox" id="category12" class="checkbox" name="category" value="12">
      <label for="category12" class="category-label">アクセサリー</label>
    <input type="checkbox" id="category13" class="checkbox" name="category" value="13">
      <label for="category13" class="category-label">おもちゃ</label>
    <input type="checkbox" id="category14" class="checkbox" name="category" value="14">
      <label for="category14r" class="category-label">ベビー・キッズ</label>

          @error('category')
            <span class="invalid-feedback" role="alert">
              {{ $message }}r
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
              <option value="{{ $condition->id }}" {{ old('condition_id') == $condition->id ? 'selected' : '' }}> {{$condition->condition_name}}</option>
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
        <label for="product_name">商品名</label>
          <input id="product_name" type="text" class="product_name" value="{{ old('product_name') }}">

            @error('product_name')
            <span class="invalid-feedback" >
              {{ $message }}
            </span>
            @enderror
      </div>

  {{-- 商品の説明 --}}
      <div class="item-description">
        <label for="description">商品の説明</label>
          <textarea id="description" class="description" name="description">{{ old('description') }}</textarea>

            @error('description')
              <span class="invalid-feedback">
                {{ $message }}
              </span>
            @enderror
      </div>

  {{-- 販売価格 --}}
      <div class="item-price">
        <label for="price">販売価格</label>
          <input id="price" type="number" class="" name="price" placeholder="¥" value="{{ old('price') }}">

            @error('price')
              <span class="invalid-feedback">
                {{ $message }}
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

@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css')}}">
@endsection

@section('content')
<div class="container">
    <h1 class="sell-product">商品の出品</h1>
      <form method="post" action="{{ route('store.sell') }}" enctype="multipart/form-data">
      @csrf

      <div class="image-box">
        <div class="form__group-title">
          <span class="form__label--item">商品画像</span>
        </div>
        <div class="image-border">
          <input type="file" class="img-input" name="image" id="imageInput">
          <label for="imageInput" class="img-label">画像を選択する</label>
        </div>
      </div>

      <div class="form__error">
        @error('image')
          <span class="invalid-feedback" role="alert">
            {{ $message }}
          </span>
        @enderror
      </div>


    <div class="item-detail">
      <h2 class="title">商品の詳細</h2>

      <div class="category-condition__group">
          <h3 class="category-group_title">カテゴリー</h3>
          <div class="category-group">
          <input type="checkbox" id="category1" class="checkbox" name="category[]" value="1">
            <label for="category1" class="category-label">ファッション</label>
          <input type="checkbox" id="category2" class="checkbox" name="category[]" value="2">
            <label for="category2" class="category-label">家電</label>
          <input type="checkbox" id="category3" class="checkbox" name="category[]" value="3">
            <label for="category3" class="category-label">インテリア</label>
          <input type="checkbox" id="category4" class="checkbox" name="category[]" value="4">
            <label for="category4" class="category-label">レディース</label>
          <input type="checkbox" id="category5" class="checkbox" name="category[]" value="5">
            <label for="category5" class="category-label">メンズ</label>
          <input type="checkbox" id="category6" class="checkbox" name="category[]" value="6">
            <label for="category6" class="category-label">コスメ</label>
          <input type="checkbox" id="category7" class="checkbox" name="category[]" value="7">
            <label for="category7" class="category-label">本</label>
          <input type="checkbox" id="category8" class="checkbox" name="category[]" value="8">
            <label for="category8" class="category-label">ゲーム</label>
          <input type="checkbox" id="category9" class="checkbox" name="category[]" value="9">
            <label for="category9" class="category-label">スポーツ</label>
          <input type="checkbox" id="category10" class="checkbox" name="category[]" value="10">
            <label for="category10" class="category-label">キッチン</label>
          <input type="checkbox" id="category11" class="checkbox" name="category[]" value="11">
            <label for="category11" class="category-label">ハンドメイド</label>
          <input type="checkbox" id="category12" class="checkbox" name="category[]" value="12">
            <label for="category12" class="category-label">アクセサリー</label>
          <input type="checkbox" id="category13" class="checkbox" name="category[]" value="13">
            <label for="category13" class="category-label">おもちゃ</label>
          <input type="checkbox" id="category14" class="checkbox" name="category[]" value="14">
            <label for="category14r" class="category-label">ベビー・キッズ</label>
          </div>
          <div class="form__error">
            @error('category')
              <span class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
            @enderror
        </div>
      </div>

      <div class="condition-group_title">
        <h3>商品の状態</h3>
        <div class="condition-group">
          <select name="condition_id" class="select-condition">
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

  <div class="name-description__group">
    <h2 class="title">商品名と説明</h2>
      <div class="item-name">
        <h3 class="name-group_title">商品名</h3>
          <input id="product_name" name="product_name" type="text" class="product_name" value="{{ old('product_name') }}">

        <div class="form__error">
          @error('product_name')
            <span class="invalid-feedback" >
              {{ $message }}
            </span>
          @enderror
        </div>
      </div>

        <h3 class="name-group_title">ブランド名</h3>
          <input id="product_name" name="brand" type="text" class="product_name" value="{{ old('brand') }}">
        <div class="form__error">
          @error('brand')
            <span class="invalid-feedback" >
              {{ $message }}
            </span>
          @enderror
        </div>
  </div>



        <h3 class="description-group_title">商品の説明</h3>
          <textarea id="description" class="product_description" name="description" cols="50" rows="10">{{ old('description') }}</textarea>

          <div class="form__error">
            @error('description')
              <span class="invalid-feedback">
                {{ $message }}
              </span>
            @enderror
          </div>
      </div>

        <h3 class="price-group_title">販売価格</h3>
          <input id="price" type="number" class="product_price" name="price" placeholder="¥" value="{{ old('price') }}">

          <div class="form__error">
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
@endsection

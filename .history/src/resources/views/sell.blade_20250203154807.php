@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css')}}">
@endsection

@section('content')
<div class="container">

  <div class="row">
    <div class="">
      <h1>商品の出品</h1>
        <form method="" action="{{ route('sell') }}" class="" enctype="multipart/form-data">
        @csrf

          {{-- 商品画像 --}}
    <div class="image-box">
      <h4>商品画像</h4>
        <input type="file" name="item-image" class="image" accept="image/png,image/jpeg,image/gif"/>
            <button>画像を選択する</button>
                <img src="/images/item-image-default.png">
        @error('item-image')
          <div style="color: #E4342E;" role="alert">
            <strong>{{ $message }}</strong>
          </div>
        @enderror
    </div>

  <div class="category-condition">
    <h2 class="title">商品の詳細</h2>

    <div class="form__group-title">
      <span class="form__label--item">カテゴリー</span>
    </div>
        <form action="radio.php" method="post">
          <input type="radio" name="category" value="1" id="fashion">
            <label for="fashion" class="label">ファッション</label>
          <input type="radio" name="category" value="2" id="appliance">
            <label for="appliance" class="label">家電</label>
          <input type="radio" name="category" value="3" id="interior">
            <label for="interior" class="label">インテリア</label>
          <input type="radio" name="category" value="4" id="women">
            <label for="women" class="label">レディース</label>
          <input type="radio" name="category" value="5" id="men">
            <label for="men" class="label">メンズ</label>
          <input type="radio" name="category" value="6" id="cosme">
            <label for="cosme" class="label">コスメ</label>
          <input type="radio" name="category" value="7" id="book">
            <label for="book" class="label">本</label>
          <input type="radio" name="category" value="8" id="game">
            <label for="game" class="label">ゲーム</label>
          <input type="radio" name="category" value="9" id="sports">
            <label for="sports" class="label">スポーツ</label>
          <input type="radio" name="category" value="10" id="kitchen">
            <label for="kitchen" class="label">キッチン</label>
          <input type="radio" name="category" value="11" id="handmade">
            <label for="handmade" class="label">ハンドメイド</label>
          <input type="radio" name="category" value="12" id="accessory">
            <label for="accessory" class="label">アクセサリー</label>
          <input type="radio" name="category" value="13" id="toy">
            <label for="toy" class="label">おもちゃ</label>
          <input type="radio" name="category" value="14" id="baby">
            <label for="baby" class="label">ベビー・キッズ</label>
      </form>
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
      </div>
                    {{-- 商品名 --}}
                    <div class="form-group mt-3">
                        <label for="name">商品名</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- 商品の説明 --}}
                    <div class="form-group mt-3">
                        <label for="description">商品の説明</label>
                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>



                    {{-- 販売価格 --}}
                    <div class="form-group mt-3">
                        <label for="price">販売価格</label>
                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-0 mt-3">
                        <button type="submit" class="btn btn-block btn-secondary">
                            出品する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

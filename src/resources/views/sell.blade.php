@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css')}}">
@endsection

@section('content')
<div class="container">
    <h1 class="sell-item">商品の出品</h1>
      <form method="post" action="{{ route('store.sell') }}" enctype="multipart/form-data">
      @csrf

      <div class="image-box">
        <div class="form__group-title">
          <span class="form__label--item">商品画像</span>
        </div>

        <div class="sell__img">
          <img class="upload__img" id="myImage">
      </div>
      <div class="select_image--btn">
          <label class="btn2">
              画像を選択する
              <input id="target" class="btn2--input" type="file" name="image" accept="image/png, image/jpeg">
          </label>
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
            @foreach($categories as $category)
              <input name="categories[]" id="{{$category->id}}" type="checkbox" class="checkbox" value="{{$category->id}}">
              <label for="{{$category->id}}" class="category-label">{{$category->content}}</label>
            @endforeach
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
          <input id="item_name" name="item_name" type="text" class="item_name" value="{{ old('item_name') }}">

        <div class="form__error">
          @error('item_name')
            <span class="invalid-feedback" >
              {{ $message }}
            </span>
          @enderror
        </div>
      </div>

        <h3 class="name-group_title">ブランド名</h3>
          <input id="item_name" name="brand" type="text" class="item_name" value="{{ old('brand') }}">
        <div class="form__error">
          @error('brand')
            <span class="invalid-feedback" >
              {{ $message }}
            </span>
          @enderror
        </div>
  </div>



        <h3 class="description-group_title">商品の説明</h3>
          <textarea id="description" class="item_description" name="description" cols="50" rows="10">{{ old('description') }}</textarea>

          <div class="form__error">
            @error('description')
              <span class="invalid-feedback">
                {{ $message }}
              </span>
            @enderror
          </div>
      </div>

        <h3 class="price-group_title">販売価格</h3>
          <input id="price" type="number" class="item_price" name="price" placeholder="¥" value="{{ old('price') }}">

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

  <script>
    const target = document.getElementById('target');
    target.addEventListener('change',function(e){
      const file = e.target.files[0];
      const reader = new FileReader();
      reader.onload = function(e){
        const img = document.getElementById("myImage");
        img.src = e.target.result;
      };
        reader.readAsDataURL(file);
        });
  </script>
@endsection

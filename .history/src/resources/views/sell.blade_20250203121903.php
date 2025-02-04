@extends('layouts.app')

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/profile.css')}}"> --}}
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
                        <input type="file" name="item-image" class="d-none" accept="image/png,image/jpeg,image/gif" id="item-image" />
                        <label for="item-image" class="d-inline-block" role="button">
                            <img src="/images/item-image-default.png" style="object-fit: cover; width: 300px; height: 300px;">
                        </label>
                    @error('item-image')
                        <div style="color: #E4342E;" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    ,/div> 
                    {{-- カテゴリ --}}
                    <div class="form-group mt-3">
                      <label for="category">カテゴリ</label>
                        <select name="category" class="custom-select form-control @error('category') is-invalid @enderror">
                        {{-- 次のパートで実装します --}}
                                          </select>
                        @error('category')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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


                    {{-- 商品の状態 --}}
                    <div class="form-group mt-3">
                        <label for="condition">商品の状態</label>
                        <select name="condition" class="custom-select form-control @error('condition') is-invalid @enderror">
                            {{-- 次のパートで実装します --}}
                        </select>
                        @error('condition')
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

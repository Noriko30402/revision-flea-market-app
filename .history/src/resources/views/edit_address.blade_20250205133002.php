@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/edit.css')}}">
@endsection

@section('content')
    <div class="register__content">
      <div class="register-form__heading">
        <h2>住所の変更</h2>
      </div>
          @csrf

        {{-- <form action="{{ route('profile.storeOrUpdate') }}" method="POST">
        @csrf --}}

      <div class="form__box">

          <div class="form__group">
            <div class="form__group-title">
              <span class="form__label--item">郵便番号</span>
            </div>
            <div class="form__group-content">
              <div class="form__input--text">
                <input type="postcode" name="postcode" value="{{ $profile->postcode}}" />
              </div>
              <div class="form__error">
                @error('postcode')
                {{ $message }}
                @enderror
              </div>
            </div>
          </div>

          <div class="form__group">
            <div class="form__group-title">
              <span class="form__label--item">住所</span>
            </div>
            <div class="form__group-content">
              <div class="form__input--text">
                <input type="address" name="address"  value="{{ $profile->address }}"/>
              </div>
              <div class="form__error">
                @error('address')
                {{ $message }}
                @enderror
              </div>
            </div>
          </div>
  
          <div class="form__group">
            <div class="form__group-title">
              <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
              <div class="form__input--text">
                <input type="building" name="building"  value="{{ $profile->building }}" />
              </div>
            </div>
          </div>
  
          <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
          </div>
        </div>
      </form>
  
    </div>
    </div>
@endsection
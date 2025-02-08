@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/edit.css')}}">
@endsection

@section('content')
    <div class="register__content">
      <div class="register-form__heading">
        <h2>プロフィール設定</h2>
      </div>
      {{-- <form action="{{ route('mypage.store') }}" method="POST">
        @csrf --}}
        {{-- <form method="POST" action="{{ route( 'mypage.images', Auth::user() )}}" enctype="multipart/form-data"> --}}
          @csrf

          <div class="profile-container">
            <label for="profile-image">
        </div>
      </form>

    </div>

      <form action="{{ route('mypage.store') }}" method="POST">
        @csrf

      <div class="form__box">
          <div class="group">
            <div class="form__group-title">
              <span class="form__label--item">ユーザー名</span>
            </div>

            <div class="form__group-content">
              <div class="form__input--text">
                <input type="text" name="name" value="{{$profile->name }}">
              </div>
              <div class="form__error">
                @error('name')
                {{ $message}}
                @enderror
              </div>
            </div>
          </div>
  
          <div class="form__group">
            <div class="form__group-title">
              <span class="form__label--item">郵便番号</span>
            </div>
            <div class="form__group-content">
              <div class="form__input--text">
                <input type="postcode" name="postcode" value="{{ old('postcode', $user ?? ''['postcode'] ?? '') }}" /> 
                {{-- <input type="postcode" name="postcode" value="{{ old('postcode') }}" />{{ $user ?? ''->postcode }}  --}}
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
                <input type="address" name="address"  value="{{ old('address', $user ?? ''['address'] ?? '') }}"/>
                {{-- <input type="address" name="address"  value="{{ old('address') }}"/>{{ $user ?? ''->address }} --}}
  
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
                <input type="building" name="building"  value="{{ old('building', $user ?? ''['building'] ?? '') }}" />
                {{-- <input type="building" name="building"  value="{{ old('building')  }}" />{{ $user ?? ''->building }} --}}
  
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
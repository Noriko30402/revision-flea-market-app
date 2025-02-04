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
        <form method="POST" action="{{ route( 'mypage.images', Auth::user() )}}" enctype="multipart/form-data">
          @csrf

          <div class="profile-container">
            <label for="profile-image">
                @if (isset($profile) && $profile->image === null)
                    <img class="rounded-circle" src="{{ asset('default.png') }}" alt="プロフィール画像" width="100" height="100">
                @elseif (isset($profile))
                    <img class="rounded-circle" src="{{ Storage::url($profile->image) }}" alt="プロフィール画像" width="100" height="100">
                @else
                    <img class="rounded-circle" src="{{ asset('default.png') }}" alt="プロフィール画像" width="100" height="100">
                @endif
                <input id="profile-image" name="image" type="file" class="form-control @error('image') is-invalid @enderror" style="display:none;" value="" accept="image/png, image/jpeg">
            </label>
            <button type="button" class="img-input" onclick="document.getElementById('profile-image').click();">画像を選択</button>
        </div>
      </form>
          {{-- <label for="profile-image">
            @if (isset($profile) && $profile->image === null)
                <img class="rounded-circle" src="{{ asset('default.png') }}" alt="プロフィール画像" width="100" height="100">
            @else
               <img class="rounded-circle" src="{{ Storage::url($profile ?? ''->image) }}" alt="プロフィール画像" width="100" height="100">
            @endif
            <input id="profile-image" name="image" type="file" class="form-control @error('profile-image') is-invalid @enderror" style="display:none;" value="" accept="image/png, image/jpeg">
        </label>
          <button type="button" class="img-input">画像を選択</button> --}}

    </div>
          {{-- <div class="image-container"> --}}
          {{-- @if(isset($user->image))
              <img src="{{ asset('storage/' . $user->image) }}" class="profile-img" alt="User Image">
          @else
              <div class="profile-img"></div>
          @endif --}}
          {{-- <button type="button" class="img-input">画像を選択</button> --}}
            {{-- <input type="file" name="image" id="image" style="display: none;">
            <button type="button" class="img-input" onclick="document.getElementById('image').click();">画像を選択</button> --}}
        

      <form action="{{ route('mypage.store') }}" method="POST">
        @csrf

      <div class="form__box">
          <div class="group">
            <div class="form__group-title">
              <span class="form__label--item">ユーザー名</span>
            </div>

            <div class="form__group-content">
              <div class="form__input--text">
                <input type="text" name="name" value="{{ old('name', $user ?? ''['name'] ?? '')}}">
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
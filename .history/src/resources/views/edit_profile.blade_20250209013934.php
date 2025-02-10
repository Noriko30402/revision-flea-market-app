@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/edit.css')}}">
@endsection

@section('content')
    <div class="register__content">
      <div class="register-form__heading">
        <h2>プロフィール設定</h2>
      </div>
      <form action="{{ route('profile.storeOrUpdate') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="profile-container">
          <img src="{{ asset('storage/images/' . ($profile->image ?? 'default.jpg')) }}" class="profile-img" />
          <input type="file" class="img-input" name="image" id="imageInput">
          <label for="imageInput" class="img-label">ファイルを選択してください</label>
      </div>

          {{-- <div class="profile-container">
            <img src="{{ asset('storage/images/' . ($profile->image ?? 'images/default.jpg')) }}" class="profile-img" />
            <input type="file" class="img-input" name='image' value="画像を選択する">
          </div> --}}
    </div>

    <div class="form__box">
          <div class="group">
            <div class="form__group-title">
              <span class="form__label--item">ユーザー名</span>
            </div>

            <div class="form__group-content">
              <div class="form__input--text">
                <input type="text" name="name" value="{{$profile->name?? '' }}">
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
                <input type="postcode" name="postcode" value="{{ $profile->postcode?? '' }}" /> 
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
                <input type="address" name="address"  value="{{ $profile->address ?? ''}}"/>

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
                <input type="building" name="building"  value="{{ $profile->building ?? '' }}" />
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
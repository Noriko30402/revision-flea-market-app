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

          <div class="profile-img">
              @if (isset($profile->image))
                  <img id="myImage" class="profile-img" src="{{ asset('storage/images/' . ($profile->image )) }}" alt="">
              @else
                  <img id="myImage" class="profile-img" src="{{asset('storage/images/' . ('default.jpg' )) }}" alt="">
              @endif
          </div>
          <div class="profile__user--btn">
              <label class="btn2">
                  画像を選択する
                  <input id="target" class="btn2--input" type="file" name="img_url" >
              </label>
          </div>

            @error('image')
            {{ $message}}
            @enderror
          </div>
        </div>

      <div class="form__box">
        <div class="form__group">
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

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">郵便番号</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="postcode" value="{{ $profile->postcode?? '' }}" />
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
            </div>
          </div>
        </div>

          <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
          </div>
        </div>
      </form>
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
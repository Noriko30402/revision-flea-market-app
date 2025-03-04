@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/item.css')}}">
@endsection

@section('content')
<div class="item">

  <div class="item-image">
    @if ($item->image && file_exists(public_path('storage/product_images/' . $item->image)))
      <img class="item-image" src="{{ asset('storage/product_images/' . $item->image) }}" alt="{{ $item->item_name }}">
    @else
      <img src="{{ $item->image }}" alt="{{ $item->name }}">
    @endif
  </div>

    <div class="item-box">

      <div class="item-detail">
        <h1 class="item-name">{{ $item->item_name }}</h1>
        <p>{{ $item ->brand }}</p>
        <p class="item-price">¥{{ number_format($item->price) }}(税込)</p>

        <div class="favorite-comment">
          <div class="favorite">
            @if($item->favorites()->where('user_id', Auth::id())->exists())
              <form action="{{ route('item.unfavorite', $item->id) }}" method="post">
              @csrf
                <button type="submit" class="btn btn-danger custom-button">
                  <i class="bi bi-star-fill custom-icon"></i>
                </button>
              </form>
            @else
              <form action="{{ route('item.favorite', $item->id) }}" method="post">
              @csrf
                <button type="submit" class="btn btn-danger custom-button">
                  <i class="bi bi-star custom-icon"></i>
                </button>
              </form>
            @endif
              <p>{{ $item->favorites()->count() }}</p>
      </div>

          <div class="comment">
            <i class="bi bi-chat custom-icon"></i>
            <p>{{  $item-> Comments() ->count()  }}</p>
          </div>
      </div>
      <form action="{{ route('purchase.item', $item->id) }}" method="post">
        @csrf
        <button class="buy-button">
          購入手続きへ
        </button>
      </form>


    <h3>商品説明</h3>
      <p class="item-description">{{$item->description}}</p>

    <h3>商品の情報</h3>
      <table class  ="category-condition_table">
        <tr class="category-row">
          <th class="category-header">カテゴリー : </th>
          @foreach($item->categories as $category)
          <td class="confirm-table__category">{{ $category->content }}</td>
          <input type="hidden" name="category_ids[]" value="{{ $category->id }}">
          @endforeach
        </tr>
        <tr class="condition-row">
          <th class="condition-header">商品の状態 : </th>
          <td class="confirm-table__condition">{{ $condition->condition_name }}
          <input type="hidden" name="" value="{{ $item['condition_id']}}">
          </td>
        </tr>
      </table>

    </div>
      <div class="comment-count">
        <h3>コメント（ {{$item-> Comments() ->count()}} )</h3>
      </div>

      <div class="comment-box">
        @foreach ($item->comments as $comment)
          <div class="comment-box-person">
            @if($comment->user &&  $comment->user->profile)
              <img src="{{ asset('storage/images/' . ($comment->user->profile->image ?? 'default.jpg')) }}" class="profile-img" />
            @endif

            <p class="comment-person">投稿者：
              @if ($comment->user && $comment->user->profile)
                {{ $comment->user->profile->name }}</p>
              @else
                  名前が設定されていません
              @endif
          </div>

          <p class="comment-content">{{ $comment->content }}</p>
        @endforeach
      </div>

      <div class="comment-view">
        <h3>商品へのコメント</h3>
        <div class="form__error">
          @error('content')
            <span class="invalid-feedback" role="alert">
              {{ $message }}
            </span>
          @enderror
        </div>
          @auth
            <form action="{{ route('comments.store' , $item->id) }}" method="POST">
            @csrf
              <div class="comment-box">
                <textarea name="content"  cols="50" rows="10">{{ old('content') }}</textarea>
              </div>
              <button type="submit" class="comment-submit__button">コメントを送信する</button>
            </form>
          @else
            <div class="comment-box">
              <textarea name="content"  cols="50" rows="10"></textarea>
            </div>
            <button type="button" class="comment-submit__button" onclick="window.location='{{ route('login') }}'">コメントを送信する</button>
          @endauth

  </div>
</div>
@endsection


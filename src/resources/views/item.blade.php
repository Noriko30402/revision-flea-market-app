@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/item.css')}}">
@endsection

@section('content')
<div class="product">

  <div class="product-image">
    @if ($product->image && file_exists(public_path('storage/product_images/' . $product->image)))
      <img class="product-image" src="{{ asset('storage/product_images/' . $product->image) }}" alt="{{ $product->product_name }}">
    @else
      <img src="{{ $product->image }}" alt="{{ $product->name }}">
    @endif
  </div>

    <div class="product-box">

      <div class="product-detail">
        <h1 class="product-name">{{ $product->product_name }}</h1>
        <p class="product-price">¥{{ number_format($product->price) }}(税込)</p>

        <div class="favorite-comment">
          <div class="favorite">
            @if($product->favorites()->where('user_id', Auth::id())->exists())
              <form action="{{ route('product.unfavorite', $product->id) }}" method="post">
              @csrf
                <button type="submit" class="btn btn-danger custom-button">
                  <i class="bi bi-star-fill custom-icon"></i>
                </button>
              </form>
            @else
              <form action="{{ route('product.favorite', $product->id) }}" method="post">
              @csrf
                <button type="submit" class="btn btn-danger custom-button">
                  <i class="bi bi-star custom-icon"></i>
                </button>
              </form>
            @endif
              <p>{{ $product->favorites()->count() }}</p>
      </div>

          <div class="comment">
            <i class="bi bi-chat custom-icon"></i>
            <p>{{  $product-> Comments() ->count()  }}</p>
          </div>
      </div>

      <form action="{{ route('purchase', $product->id) }}" method="get">
      @csrf
        <button class="buy-button">
          購入手続きへ
        </button>
      </form>


    <h3>商品説明</h3>
      <p class="product-description">{{$product->description}}</p>

    <h3>商品の情報</h3>
      <table class  ="category-condition_table">
        <tr class="category-row">
          <th class="category-header">カテゴリー : </th>
          @foreach($product->categories as $category)
          <td class="confirm-table__category">{{ $category->content }}</td>
          <input type="hidden" name="category_ids[]" value="{{ $category->id }}">
          @endforeach
        </tr>
        <tr class="condition-row">
          <th class="condition-header">商品の状態 : </th>
          <td class="confirm-table__condition">{{ $condition->condition_name }}
          <input type="hidden" name="" value="{{ $product['condition_id']}}">
          </td>
        </tr>
      </table>

    </div>
      <div class="comment-count">
        <h3>コメント（ {{$product-> Comments() ->count()}} )</h3>
      </div>

      <div class="comment-box">
        @foreach ($product->comments as $comment)
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
          @auth
            <form action="{{ route('comments.store' , $product->id) }}" method="POST">
            @csrf
              <div class="comment-box">
                <textarea name="content"  cols="50" rows="10"></textarea>
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


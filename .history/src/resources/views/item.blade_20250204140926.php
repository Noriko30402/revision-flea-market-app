@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/item.css')}}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}
@endsection

@section('content')
<div class="product">

  <div class="product-image">
    <img src="{{ $product->image }}" alt="{{ $product->name }}">
  </div>

    <div class="product-box">

      <div class="product-detail">
        <h1 class="product-name">{{ $product->product_name }}</h1>
        <p class="product-price">¥{{ $product->price }}(税込)</p>

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
          {{-- <div class="favorite-count"> --}}
              <p class="favorite-count">{{ $product->favorites()->count() }}</p>
          {{-- </div> --}}
      </div>

          <div class="comment">
            <i class="bi bi-chat custom-icon"></i>
            <p class="comment-count">{{  $product-> Comments() ->count()  }}</p>
          </div>
      </div>

        <h3>商品説明</h3>

    <p class="product-description">{{$product->description}}</p>
    <h3>商品の情報</h3>
    <table>
      <tr>
        <th>カテゴリー</th>
        @foreach($product->categories as $category)
        <td class="confirm-table__category">{{ $category->name }}</td>
        <input type="hidden" name="category_ids[]" value="{{ $category->id }}">
        @endforeach
      </tr>
      <tr>
        <th>商品の状態</th>
      <td class="confirm-table__condition">{{ $condition->name }}
        <input type="hidden" name="" value="{{ $product['condition_id']}}">
      </td>
    </tr>
    </table>
  </div>



{{-- コメント一覧 --}}

        <p>コメント（ {{$product-> Comments() ->count()}} )</p>


@foreach ($product->comments as $comment)
<div class="comment-index">
  <p class="comment-content">{{ $comment->content }}</p>
  <p class="comment-person">投稿者：
    @if ($comment->user && $comment->user->profile)
    {{ $comment->user->profile->name }}</p>
     @else
            名前が設定されていません
    @endif

  {{-- <p class="comment-person">投稿者：{{ $comment->profile->name }}</p> --}}
</div>
@endforeach


  <h2>コメントを投稿する</h2>
  @auth
    <form action="{{ route('comments.store' , $product->id) }}" method="POST">
    @csrf
    <div class="comment-box">
      <label for="content" class="comment-form">商品へのコメント</label>
      <textarea name="content"  cols="30" rows="3"></textarea>
    </div>
    <button type="submit">コメントを送信する</button>
    </form>
  @else
    <div class="comment-box">
      <label for="content" class="comment-form">商品へのコメント</label>
      <textarea name="content"  cols="30" rows="3"></textarea>
    </div>
    <button type="submit">コメントを送信する</button>
  @endauth


</div>
@endsection


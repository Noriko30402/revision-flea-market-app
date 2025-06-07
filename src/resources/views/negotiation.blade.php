@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/negotiation.css')}}">
@endsection

@section('content')
<div class="container">

  <div class="sidebar">
    <h2>その他の取引</h2>
    @foreach ( $negotiationItems as  $negotiationItem)
    <ul>
      <li class="item">
        <a href="{{ route('negotiation.index', ['item_id' => $negotiationItem->item_id, 'orderId' => $negotiationItem->id  ]) }}">
          <h3 class="item-name">{{ $negotiationItem->item->item_name  }} </h3>
        </a>
      </li>
    </ul>
    @endforeach
  </div>

  <div class="chat">
    <div class="title">
      <img src="{{ asset('storage/images/' . ($profile->image ?? 'default.jpg')) }}" class="profile-img" />
      <h2 class="user_name">「{{$profileName}}」さんとの取引画面</h2>
      <a href="#modal-complete" class="complete">取引を完了する</a>
    </div>

  {{-- モーダル --}}
    <div class="modal" id="modal-complete">
      <a href="#!" class="modal-overlay"></a>
        <div class="modal__inner">
          <div class="modal__content">
            <h2>取引が完了しました。</h2>
              <form class="modal__detail-form" action="{{ route('review')}}" method="post">
              @csrf
                <input type="hidden" name="receiver_id" value="{{ $partnerId }}">
                <input type="hidden" name="order_id" value="{{ $orderId }}">

                <div class="modal-form__group">
                  <p>今回の取引相手はどうでしたか</p>
                    <div class="star-rating">
                      @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="stars" value="{{ $i }}">
                        <label for="star{{ $i }}">★</label>
                      @endfor
                    </div>
                  <button class="modal-btn" type="submit">送信</button>
                </div>
              </form>
            </div>
        </div>
    </div>
  </div>

  <div class="product-box">
    <img class="item-image" src="{{ asset('storage/product_images/' . $item->image) }}" alt="{{ $item->item_name }}">
    <div class="item-details">
      <h1 class="item-name">{{ $item->item_name }}</h1>
      <p class="item-price">¥{{ number_format($item->price) }}(税込)</p>
    </div>
  </div>

    <div class="message-box">
      @foreach($messages as $message)
      <div class="message-entry {{ $message->sender_id === auth()->id() ? 'sender' : 'receiver' }}">
          @if($editId == $message->id && $message->sender_id === auth()->id())
            <form action="{{ route('message.update', $message->id) }}" method="POST">
            @csrf
            @method('PUT')
              <textarea name="content">{{ old('content', $message->content) }}</textarea>
              <button type="submit">保存</button>
              <a href="{{ route('negotiation.index', ['item_id' => $item->id, 'orderId' => $orderId]) }}">キャンセル</a>
            </form>
          @else
          <div class="account">
            <p class="name">{{ $message->sender->name }}</p>
            <img class="user-img" src="{{ asset('storage/images/' . ($message->sender->profile->image ?? 'default.jpg')) }}" />
          </div>
            <p class="content">{{ $message->content }}</p>
          @endif

          @if($message->sender_id === auth()->id()&& $editId != $message->id)
          <div class="actions">
            <a class="edit" href="{{ route('negotiation.index', ['item_id' => $item->id, 'orderId' => $orderId, 'edit' => $message->id]) }}">編集</a>
            <form class="delete" action="{{ route('message.delete', $message->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit">削除</button>
            </form>
          </div>
        @endif
      </div>
      @endforeach
    </div>

    <div class="message">
      <div class="form__error">
        @error('content')
          {{ $message }}
        @enderror
        @error('img_url')
          {{ $message}}
        @enderror
      </div>
      <form method="POST" action="{{ route('chat.send') }}" enctype="multipart/form-data" class="message-form">
        @csrf
          <input type="hidden" name="sender_id" value="{{ auth()->id() }}">
          <input type="hidden" name="receiver_id" value="{{ $partnerId }}">
          <input type="hidden" name="item_id" value="{{ $item->id }}">
          <input type="hidden" name="order_id" value="{{ $orderId }}">

          <textarea name="content"  class="message-textarea"></textarea>
          <label class="btn2">
            画像を追加
            <input id="target" class="btn2--input" type="file" name="img_url" >
          </label>

        <button type="submit" class="send-button">
          <i class="bi bi-send"></i>
        </button>

      </form>
    </div>
  </div>
</div>
@endsection



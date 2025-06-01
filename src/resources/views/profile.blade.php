@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css')}}">
@endsection

@section('content')
<div class="container">

    <form action="{{ route('mypage.profile') }}" method="GET">
      <div class="profile-heading">
        <img src="{{ asset('storage/images/' . ($profile->image ?? 'default.jpg')) }}" class="profile-img" />
        <input type="text" class="user_name" name="name" value="{{$profile->name?? '' }}">
        <button type="submit" class="profile-button">プロフィールを編集</button>
      </div>
    </form>

  <div class="contents">
    <ul class="tabs">
      <li><a href="{{ route('mypage', ['tab' => 'sell']) }}" class="{{ request('tab', 'sell') == 'sell' ? 'active' : '' }}">出品した商品</a></li>
      <li><a href="{{ route('mypage', ['tab' => 'buy']) }}" class="{{ request('tab') == 'buy' ? 'active' : '' }}">購入した商品</a></li>
      <li><a href="{{ route('mypage', ['tab' => 'negotiation']) }}" class="{{ request('tab') == 'negotiation' ? 'active' : '' }}">取引中の商品</a></li>
    </ul>

    <div class="tab-content">
      @if($tab == 'sell')
        <div class="sell-tab">
          @if($items->isEmpty())
            <p>出品した製品がありません。</p>
          @else
            @foreach($items as $item)
              <li class="item-item">
                <a href="{{ route('item.show', $item->id) }}">
                    <img class="item-image" src="{{ asset('storage/product_images/' . $item->image) }}" alt="{{ $item->item_name }}">
                  @if ($item ->is_sold == true)
                    <h3 class="item-name">{{ $item->item_name}} <span style="color: red;"> < Sold ></h3>
                  @else
                    <h3 class="item-name">{{ $item->item_name }}</h3>
                  @endif
                </a>
              </li>
            @endforeach
          @endif
        </div>

      @elseif($tab == 'buy')
        <div class="buy-tab">
          @if ($buyItems->isEmpty())
            <p>購入した商品がありません。</p>
          @else
            @foreach ( $buyItems as  $buyItem)
              <li class="item">
                <a href="{{ route('item.show' ,$buyItem->item_id)}}">
                  <img class="item-image" src="{{ asset('storage/product_images/' . $buyItem->item->image ) }}" alt="{{ $buyItem->item->item_name }}">
                  @if ($buyItem ->item ->is_sold == true)
                    <h3 class="item-name">{{ $buyItem->item->item_name }} <span style="color: red;"> < Sold ></h3>
                  @else
                    <h3 class="item-name">{{  $buyItem->item->item_name  }}</h3>
                  @endif
                </a>
              </li>
            @endforeach
          @endif

      @elseif($tab == 'negotiation')
        <div class="buy-tab">
          @if ($negotiationItems->isEmpty())
            <p>取引中の商品がありません。</p>
          @else
            @foreach ( $negotiationItems as  $negotiationItem)
              <li class="item">
                <a href="{{ route('negotiation.index', ['item_id' => $negotiationItem->item_id, 'partnerId' => $negotiationItem->item->user_id]) }}">
                  <img class="item-image" src="{{ asset('storage/product_images/' . $negotiationItem->item->image) }}" alt="{{ $negotiationItem->item->item_name }}">
                  @if ( $negotiationItem ->item ->is_sold == true)
                    <h3 class="item-name">{{ $negotiationItem->item->item_name  }} <span style="color: red;"> < Sold ></h3>
                  @else
                    <h3 class="item-name">{{ $negotiationItem->item->item_name  }}</h3>
                  @endif
                </a>
              </li>
            @endforeach
          @endif

      @endif
    </div>
  </div>
@endsection
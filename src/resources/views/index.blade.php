@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
<div class="container">

<div class="contents">
  <ul class="tabs">
    <li><a href="{{ route('index', ['tab' => 'recommendations']) }}"class="{{ request('tab', 'recommendations') == 'recommendations' ? 'active' : '' }}">おすすめ</a></li>
    <li><a href="{{ route('index', ['tab' => 'mylist']) }}" class="{{ request('tab') == 'mylist' ? 'active' : '' }}">マイリスト</a></li>
  </ul>
@if (session('review'))
    <div class="alert alert-danger">
        {{ session('review') }}
    </div>
@endif

  <div class="tab-content">
    @if($tab == 'recommendations')
        <ul class="item-container">
          @foreach($items as $item)
            <li class="item">
              <a href="{{ route('item.show', $item->id) }}">

                @if ($item->image && \Storage::exists('public/product_images/' . $item->image))
                  <img class="item-image" src="{{ asset('storage/product_images/' . $item->image) }}" alt="{{ $item->item_name }}">
                @elseif ($item->image)
                  <img class="item-image" src="{{ $item->image }}" alt="{{ $item->item_name }}">
                @else
                  <img class="item-image" src="{{ asset('storage/images/default.jpg') }}" alt="{{ $item->item_name }}">
                @endif

                @if ($item ->is_sold == true)
                  <h3 class="item-name">{{ $item->item_name}} <span style="color: red;"> < Sold ></h3>
                @else
                  <h3 class="item-name">{{ $item->item_name }}</h3>
                @endif
              </a>
            </li>
          @endforeach
        </ul>

    @elseif($tab == 'mylist')
        <ul class="item-container">
          @if($favorite_items->isEmpty())
            <p>お気に入りの商品がありません。</p>

          @else
            @foreach($favorite_items as $favorite_item)
              <li class="item">
                <a href="{{ route('item.show', $favorite_item->id) }}">
                  @if ($favorite_item->image && \Storage::exists('public/product_images/' . $favorite_item->image))
                    <img class="item-image" src="{{ asset('storage/product_images/' . $favorite_item->image) }}" alt="{{ $favorite_item->item_name }}">
                  @elseif ($favorite_item->image)
                    <img class="item-image" src="{{ $favorite_item->image }}" alt="{{ $favorite_item->item_name }}">
                  @else
                    <img class="item-image" src="{{ asset('storage/images/default.jpg') }}" alt="{{ $favorite_item->item_name }}">
                  @endif

                  @if ($favorite_item ->is_sold == true)
                    <h3 class="item-name">{{ $favorite_item->item_name}} <span style="color: red;"> < Sold ></h3>
                  @else
                    <h3 class="item-name">{{ $favorite_item->item_name }}</h3>
                @endif

                </a>
              </li>
            @endforeach
          @endif
        </ul>
    @endif
  </div>
@endsection
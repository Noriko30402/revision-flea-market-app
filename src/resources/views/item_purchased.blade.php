
<!DOCTYPE html>
<html lang="en">


<body>
  <div class="thanks-box">
        <h1 class="thanks-message">{{ $item->item_name }} が購入されました。</h3>

        <p>購入者: {{ $buyer->name }}（{{ $buyer->email }}）</p>

            <a href="{{ url('/') }}" >トップページへ</a>
    </div>
</body>
</html>
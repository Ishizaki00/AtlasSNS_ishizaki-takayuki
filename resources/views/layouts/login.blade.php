<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!--IEブラウザ対策-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ページの内容を表す文章" />
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
  <!--スマホ,タブレット対応-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Scripts -->
  <!--サイトのアイコン指定-->
  <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
  <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
  <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
  <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
  <!--iphoneのアプリアイコン指定-->
  <link rel="apple-touch-icon-precomposed" href="画像のURL" />
  <!--OGPタグ/twitterカード-->
</head>

<body>
  <header>
    @include('layouts.navigation')
  </header>
  <!-- Page Content -->
  <div id="row">
    <div id="container">
      {{ $slot }}
    </div>
    <!-- <div id="side-bar">
      <div id="confirm">
        <p>〇〇さんの</p>
        <div>
          <p>フォロー数</p>
          <p>〇〇名</p>
        </div>
        <p class="btn"><a href="">フォローリスト</a></p>
        <div>
          <p>フォロワー数</p>
          <p>〇〇名</p>
        </div>
        <p class="btn"><a href="">フォロワーリスト</a></p>
      </div>
      <p class="btn"><a href="">ユーザー検索</a></p>
    </div> -->
    <div class="side-bar">
        <div class="confirm">
          <p class="user-name">{{ Auth::user()->username }}さんの</p>
        <div class="follow-info">
          <p>フォロー数</p>
          <p class="count">{{ Auth::user()->followings->count() }}名</p>
        </div>
        <p class="side-btn"><a href="{{ url('/follows') }}" class="btn-link">フォローリスト</a></p>
        <div class="follow-info">
          <p>フォロワー数</p>
          <p class="count">{{ Auth::user()->followers->count() }}名</p>
        </div>
        <p class="side-btn"><a href="{{ url('/followers') }}" class="btn-link">フォロワーリスト</a></p>
      </div>
      <p class="side-btn"><a href="{{ url('/search') }}" class="btn-link">ユーザー検索</a></p>
    </div>

  </div>
  <footer>
  </footer>
  <!-- jqueryを読み込み、jqueryを使用するには必須↓ -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="{{ asset('js/modal.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('/js/script.js') }}"></script>
  <script src="JavaScriptファイルのURL"></script>
</body>

</html>

<x-logout-layout>
  <div id="clear">
    <div class="rigister-comp">
      <div class="rigister-title">
        <p>{{session('registered_username')}}さん</p>
        <p>ようこそ！AtlasSNSへ！</p>
      </div>
      <div class="rigister-art">
        <p>ユーザー登録が完了しました。</p>
        <p>早速ログインをしてみましょう！</p>
      </div>

      <p class="buck-btn"><a href="login">ログイン画面へ</a></p>
    </div>
  </div>
</x-logout-layout>

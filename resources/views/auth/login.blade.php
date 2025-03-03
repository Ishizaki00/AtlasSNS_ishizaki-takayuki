<x-logout-layout>
  <div class="login-box">
    <!-- 適切なURLを入力してください  追記 -->
    <!-- loginというルート名 -->
    {!! Form::open(['url' => ('login')]) !!}

    <p class="login-title">AtlasSNSへようこそ</p>

    <div class="form-group">
      {{ Form::label('email') }}
      {{ Form::text('email',null,['class' => 'input']) }}
      {{ Form::label('password') }}
      {{ Form::password('password',['class' => 'input']) }}
    </div>

    <div class="login-button">
      {{ Form::submit('ログイン') }}
    </div>

    <p class="newuser"><a href="register">新規ユーザーの方はこちら</a></p>

      {!! Form::close() !!}
  </div>

</x-logout-layout>

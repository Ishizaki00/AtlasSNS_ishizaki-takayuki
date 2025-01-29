<x-logout-layout>
  <div class="login-box">
  <!-- 適切なURLを入力してください  追記 -->
   <!-- loginというルート名 -->
  {!! Form::open(['url' => ('login')]) !!}

  <p>AtlasSNSへようこそ</p>

  {{ Form::label('email') }}
  {{ Form::text('email',null,['class' => 'input']) }}
  {{ Form::label('password') }}
  {{ Form::password('password',['class' => 'input']) }}

  {{ Form::submit('ログイン') }}

  <p><a href="register">新規ユーザーの方はこちら</a></p>

  {!! Form::close() !!}
</div>

</x-logout-layout>

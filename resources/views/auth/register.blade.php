<x-logout-layout>
  <div class="register-container">
    <!-- 適切なURLを入力してください   追記-->
    {!! Form::open(['url' => 'register']) !!}

    <h2 class="registration">新規ユーザー登録</h2>

    <div class="form-group">
      {{ Form::label('ユーザー名') }}
      {{ Form::text('username',null,['class' => 'input']) }}

      {{ Form::label('メールアドレス') }}
      {{ Form::email('email',null,['class' => 'input']) }}

      {{ Form::label('パスワード') }}
      {{ Form::text('password',null,['class' => 'input']) }}

      {{ Form::label('パスワード確認') }}
      {{ Form::text('password_confirmation',null,['class' => 'input']) }}

      {{ Form::submit('新規登録', ['class' => 'register-button']) }}
    </div>

    <p><a href="login">ログイン画面へ戻る</a></p>

    {!! Form::close() !!}

    @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
    @endif

  </div>
</x-logout-layout>

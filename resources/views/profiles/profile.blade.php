<x-login-layout>
    <div class="profile-edit-container">
        {!! Form::open(['route' => 'profile.update', 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

        <div class="form-group">
        <!-- ユーザーアイコン・ユーザー名 -->
            <div class="user-info">
                <div class="user-position">
                    @if(Auth::check() && Auth::user()->icon_image != 'icon1.png')
                        <img src="{{ asset('storage/icons/' . Auth::user()->icon_image) }}" alt="User Icon" class="user-icon">
                    @else
                        <img src="{{ asset('/images/icon1.png') }}" alt="デフォルトアイコン" class="user-icon">
                    @endif
                    {{ Form::label('ユーザー名') }}
                </div>
                    {{ Form::input('text', 'username', Auth::user()->username, ['class' => 'form-control']) }}
            </div>
        </div>

        <!-- メールアドレス -->
        <div class="form-group">
            {{ Form::label('email', 'メールアドレス') }}
            {{ Form::email('email', old('email', Auth::user()->email), ['class' => 'form-control', 'required']) }}
        </div>

        <!-- パスワード -->
        <div class="form-group">
            {{ Form::label('password', 'パスワード') }}
            {{ Form::password('password', ['class' => 'form-control']) }}
        </div>

        <!-- パスワード確認 -->
        <div class="form-group">
            {{ Form::label('password_confirmation', 'パスワード確認') }}
            {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
        </div>

        <!-- Bio -->
        <div class="form-group">
            {{ Form::label('bio', '自己紹介') }}
            {{ Form::textarea('bio', old('bio', Auth::user()->bio), ['class' => 'form-control']) }}
        </div>

        <!-- アイコン画像 -->
        <div class="form-group">
            {{ Form::label('icon_image', 'アイコン画像') }}
            {{ Form::file('icon_image', ['class' => 'form-control']) }}
        </div>

        <!-- 更新ボタン -->
        <div class="form-group">
            {{ Form::submit('更新', ['class' => 'btn btn-primary pull-right']) }}
        </div>

        {!! Form::close() !!}
    </div>
</x-login-layout>

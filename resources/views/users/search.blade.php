<x-login-layout>
<div class="container">
    <h1>ユーザー検索</h1>

    <!-- 検索フォーム -->
    <div class="search-box">
        <form action="{{ route('users.search') }}" method="GET" class="search-form">
            <input type="text" name="query" class="search-input" placeholder="ユーザー名" value="{{ request('query') }}">
            <button type="submit" class="search-btn">
                <img src="{{ asset('images/search.png') }}" alt="検索" class="search-icon">
            </button>
        </form>
        <!-- 検索ワード -->
         @if(request('query'))
            <p>検索ワード：{{ request('query') }}</p>
         @endif

    </div>

    <!-- ユーザーリスト -->
    <div class="user-list">
        <h2>登録ユーザー一覧</h2>
        <ul>
            <!-- 自分以外のユーザーを表示 -->
             <!-- foreachループ処理 -->
              <!-- 「!」は「等しくない」という意味、下記は「ログインユーザーのIDと現在のユーザーのIDが等しくない場合」という条件を表す -->
            @foreach ($users as $user)
                @if(Auth::id() != $user->id) {{-- ログインユーザーはリストに表示しない場合 --}}
        <li>
            <div class="user-icon">
                @if($user->icon_image) {{-- 各ユーザーのアイコンを参照 --}}
                    <img src="{{ asset('storage/icons/' . $user->icon_image) }}" alt="{{ $user->username }}のアイコン" class="user-icon">
                @else
                    <img src="{{ asset('/images/icon1.png') }}" alt="デフォルトアイコン" class="user-icon">
                @endif
            </div>
                    <!-- ユーザーテーブル内のusernameを出力↓、phpのechoに相当 -->
                    {{ $user->username }}

                    <!-- フォロー登録解除ボタン -->
                    @if (Auth::user()->isFollowing($user))
                <form action="{{ route('users.unfollow', $user) }}" method="POST">
                    @csrf
                    @method('DELETE') {{-- DELETEメソッドを使用 --}}
                    <button type="submit">フォロー解除</button>
                </form>
            @else
                <form action="{{ route('users.follow', $user) }}" method="POST">
                    @csrf
                    <button type="submit">フォロー</button>
                </form>
            @endif
        </li>
    @endif
@endforeach
        </ul>
    </div>
</div>


</x-login-layout>

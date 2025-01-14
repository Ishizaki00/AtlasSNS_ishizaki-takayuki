<x-login-layout>
<div class="container">
    <h1>ユーザー検索</h1>

    <!-- 検索フォーム -->
    <div class="search-box">
        <form action="" method="GET" class="search-form">
            <input type="text" name="query" class="search-input" placeholder="ユーザー名で検索" value="{{ request('query') }}">
            <button type="submit" class="search-btn">
                <img src="{{ asset('images/search.png') }}" alt="検索" class="search-icon">
            </button>
        </form>
    </div>

    <!-- ユーザーリスト -->
    <div class="user-list">
        <h2>登録ユーザー一覧</h2>
        <ul>
            <!-- 自分以外のユーザーを表示 -->
            @foreach ($users as $user)
                @if(Auth::id() != $user->id) {{-- ログインユーザーはリストに表示しない場合 --}}
                <!-- ユーザーテーブル内のusernameを表示↓ -->
                <li>{{ $user->username }}</li>
                @endif
            @endforeach
        </ul>
    </div>
</div>


</x-login-layout>

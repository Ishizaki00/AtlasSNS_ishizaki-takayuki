<x-login-layout>
    <div class="container">
        <h2>プロフィール</h2>
        <div class="profile-header">
            <!-- ユーザーアイコン -->
            @if ($user->icon_image)
                <img src="{{ asset('storage/icons/' . $user->icon_image) }}" alt="{{ $user->username }}のアイコン" class="user-icon">
            @else
                <img src="{{ asset('/images/icon1.png') }}" alt="デフォルトアイコン" class="user-icon">
            @endif

            <h3>{{ $user->username }}</h3>
            <p>{{ $user->bio ?? '自己紹介がありません。' }}</p>

            <!-- フォロー・フォロー解除ボタン -->
            @if (Auth::user()->isFollowing($user))
                <form action="{{ route('users.unfollow', $user) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">フォロー解除</button>
                </form>
            @else
                <form action="{{ route('users.follow', $user) }}" method="POST">
                    @csrf
                    <button type="submit">フォロー</button>
                </form>
            @endif
        </div>

        <h3>投稿一覧</h3>
        <div class="user-posts">
            @foreach ($user->posts as $post)
                <div class="post-item">
                    <p>{{ $post->post }}</p>
                    <small>{{ $post->created_at->format('Y-m-d H:i') }}</small>
                </div>
            @endforeach
        </div>
    </div>
</x-login-layout>

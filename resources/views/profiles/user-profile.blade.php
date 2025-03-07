<x-login-layout>
        <div class="otherprofiles-header">
            <div class="other-profiles">
                <!-- ユーザーアイコン -->
                 <div>
                    @if ($user->icon_image)
                        <img src="{{ asset('storage/icons/' . $user->icon_image) }}" alt="{{ $user->username }}のアイコン" class="user-icon">
                    @else
                        <img src="{{ asset('/images/icon1.png') }}" alt="デフォルトアイコン" class="user-icon">
                    @endif
                </div>
                    <h1 class="f-list">ユーザー名</h1>
                    <h3>{{ $user->username }}</h3>
            </div>
            <div class="self-introduction">
                <h2 class="f-list">自己紹介</h2>
                <p>{{ $user->bio ?? '自己紹介がありません。' }}</p>

                    <!-- フォロー・フォロー解除ボタン -->
                    <div class="follow-button">

                        @if (Auth::user()->isFollowing($user))
                            <form action="{{ route('users.unfollow', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                                <button type="submit" class="unfollow-button">フォロー解除</button>
                            </form>
                        @else
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                        @csrf
                            <button type="submit" class="follow-button">フォローする</button>
                        </form>
                        @endif
                    </div>
            </div>
        </div>

        <div class="post-list">
            @foreach ($user->posts as $post)
                <div class="post-item">
                    <div class="user-icon">
                    @if ($post->user->icon_image)
                        <a href="{{ route('user.profile', $post->user->id) }}">
                            <img src="{{ asset('storage/icons/' . $post->user->icon_image) }}" alt="{{ $post->user->username }}のアイコン">
                        </a>
                    @else
                        <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン">
                    @endif
                </div>
                    <div class="post-content">
                    <h4 class="username">{{ $post->user->username }}</h4>
                    <p>{{ $post->post }}</p>
                    <small class="post-date">{{ $post->created_at->format('Y-m-d H:i') }}</small>
                    </div>
                </div>
            @endforeach
        </div>
</x-login-layout>

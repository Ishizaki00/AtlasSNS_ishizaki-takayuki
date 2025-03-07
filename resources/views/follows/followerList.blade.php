<x-login-layout>
    <div class="following-header">
        <!-- フォロワーリストのタイトル -->
        <h2 class="f-list">フォロワーリスト</h2>

            <!-- フォロワーアイコンを横並びで表示 -->
            <ul class="follower-icons">
                @foreach ($followers as $follower)
                    <li>
                    @if ($follower->icon_image)
                        <a href="{{ route('user.profile', $follower->id) }}">
                            <img src="{{ asset('storage/icons/' . $follower->icon_image) }}" alt="{{ $follower->username }}のアイコン">
                        </a>
                    @else
                    <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン">
                @endif

            </li>
        @endforeach
        </ul>
    </div>

        <!-- フォロワーごとの投稿内容を表示 -->
        <div class="post-list">
        @foreach ($posts as $post)
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

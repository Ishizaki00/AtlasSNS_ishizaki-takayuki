<x-login-layout>
    <div class="following-header">
        <h2 class="f-list">フォローリスト</h2>

        <ul class="following-icons">
        @foreach ($followings as $following)
            <li>
                @if ($following->icon_image)
                    <a href="{{ route('user.profile', $following->id) }}">
                        <img src="{{ asset('storage/icons/' . $following->icon_image) }}" alt="{{ $following->username }}のアイコン">
                    </a>
                @else
                    <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン">
                @endif
            </li>
        @endforeach

        </ul>
    </div>

        <div class="post-list">
            <!-- isEmpty() メソッドは、そのコレクションが空かどうかを判定します。 -->
            <!-- @if ($posts->isEmpty())
                <p>フォローしているユーザーの投稿はありません。</p>
            @else -->
                @foreach ($posts as $post) {{-- ここで各投稿にアクセス --}}
                    <div class="post-item">
                        <div class="user-icon">
                            @if ($following->icon_image)
                                    <a href="{{ route('user.profile', $following->id) }}">
                                        <img src="{{ asset('storage/icons/' . $following->icon_image) }}" alt="{{ $following->username }}のアイコン">
                                    </a>
                                @else
                                    <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン">
                            @endif
                        </div>
                        <div class="post-content">

                            <h4 class="username">{{ $post->user->username }}</h4>
                            <p>{{ $post->post }}</p> {{-- 正しい記述: $post->post --}}
                            <small class="post-date">{{ $post->created_at->format('Y-m-d H:i') }}</small>
                        </div>
                    </div>
                @endforeach
            <!-- @endif -->
    </div>

</x-login-layout>

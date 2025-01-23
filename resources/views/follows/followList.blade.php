<x-login-layout>
  <div class="container">
    Folow List

    <!-- 自分がフォローしている人の投稿（フォロー機能できてから） -->
    <ul>
            @foreach ($followings as $following)
                <li>{{ $following->username }}</li>
            @endforeach
        </ul>

        <div class="post-list">
            <!-- isEmpty() メソッドは、そのコレクションが空かどうかを判定します。 -->
            @if ($posts->isEmpty())
                <p>フォローしているユーザーの投稿はありません。</p>
            @else
                @foreach ($posts as $post) {{-- ここで各投稿にアクセス --}}
                    <div class="post-item">
                        <div class="user-icon">
                            <img src="{{ asset('images/icon1.png') }}" alt="投稿者アイコン">
                        </div>
                        <div class="post-content">
                            <h4 class="username">{{ $post->user->username }}</h4>
                            <p>{{ $post->post }}</p> {{-- 正しい記述: $post->post --}}
                            <small>{{ $post->created_at->format('Y-m-d H:i') }}</small>
                        </div>
                    </div>
                @endforeach
            @endif
    </div>
  </div>

</x-login-layout>

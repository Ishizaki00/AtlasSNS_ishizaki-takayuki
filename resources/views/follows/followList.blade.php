<x-login-layout>
  <div class="container">
    Folow List

    <!-- 自分がフォローしている人の投稿（フォロー機能できてから） -->
    <div class="post-list">
        @foreach ($posts as $post)<!-- 投稿データを繰り返し処理で表示 -->
            <div class="post-item">
                <!-- 投稿者のアイコン（仮で固定画像） -->
                <div class="user-icon">
                    <img src="{{ asset('images/icon1.png') }}" alt="投稿者アイコン">
                </div>
                <!-- 投稿内容と投稿日時 -->
                <div class="post-content">
                    <!-- 投稿者のアカウント名 -->
                <h4 class="username">{{ $post->user->username }}</h4> <!-- 投稿者名 -->
                    <p>{{ $post->post }}</p> <!-- 投稿内容 -->
                    <small>{{ $post->created_at->format('Y-m-d H:i') }}</small> <!-- 投稿日時 -->
                </div>
            </div>
        @endforeach
    </div>
  </div>

</x-login-layout>

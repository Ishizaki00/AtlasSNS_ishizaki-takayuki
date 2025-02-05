<x-login-layout>

    <div class="container">
        <!-- フォロワーリストのタイトル -->
        <h2>フォロワーリスト</h2>

        <!-- フォロワーアイコンを横並びで表示 -->
        <div class="follower-icons">
            @foreach ($followers as $follower)
                <div class="follower-icon">
                    <!-- フォロワーのアイコン -->
                    <img src="{{ asset('storage/icons/' . $follower->icon_image) }}" alt="{{ $follower->username }}のアイコン">
                </div>
            @endforeach
        </div>

        <!-- フォロワーごとの投稿内容を表示 -->
        <div class="follower-posts">
            @foreach ($followers as $follower)
                <div class="follower-post">
                    <div class="follower-info">
                        <!-- フォロワーのアイコン -->
                        <img src="{{ asset('storage/icons/' . $follower->icon_image) }}" alt="{{ $follower->username }}のアイコン" class="follower-icon">
                        <span class="follower-name">{{ $follower->username }}</span>
                    </div>

                    <!-- フォロワーの投稿 -->
                    <div class="follower-post-content">
                        @foreach ($follower->posts as $post)
                            <p>{{ $post->post }}</p>
                            <small>{{ $post->created_at->format('Y-m-d H:i') }}</small>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>


</x-login-layout>

<x-login-layout>

<div class="post">
    <div class="post-container">
     <!-- ログインユーザーのアイコン -->
     <div class="user-icon">
        <img src="{{ asset('images/icon1.png') }}" alt="ユーザーアイコン">
    </div>

    <!-- 投稿フォーム -->
    <form action="{{ route('posts.store') }}" method="POST" class="post-form">
        @csrf
        <!-- 投稿内容入力エリア -->
        <textarea name="content" id="content" maxlength="150" placeholder="投稿内容を入力してください。" required></textarea>

        <!-- 投稿ボタン -->
        <button type="submit" class="post-button">
            <img src="{{ asset('images/post.png') }}" alt="投稿">
        </button>
    </form>
    </div>
</div>

<!-- 投稿一覧 -->
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

<!-- フロントエンドでの文字数制限チェック -->
<script>
    const textarea = document.getElementById('content');
    textarea.addEventListener('input', function () {
        if (textarea.value.length > 150) {
            alert('投稿内容は150文字以内で入力してください。');
            textarea.value = textarea.value.substring(0, 150);
        }
    });
</script>

</x-login-layout>

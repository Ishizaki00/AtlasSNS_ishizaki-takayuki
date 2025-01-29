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
        @foreach ($posts as $post)
            <div class="post-item" id="post-{{ $post->id }}">
                <div class="user-icon">
                    <img src="{{ asset('images/icon1.png') }}" alt="投稿者アイコン">
                </div>
                <div class="post-content">
                    <h4 class="username">{{ $post->user->username }}</h4>
                    <p id="post-content-{{ $post->id }}">{{ $post->post }}</p>
                    @if (Auth::id() === $post->user_id)
                    <div class="post-actions">
                        <button type="button" class="modal-button" data-post-id="{{ $post->id }}">
                            <img src="{{ asset('images/edit.png') }}" alt="編集" width="20" height="20">
                        </button>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('本当に削除しますか？')">
                                <img src="{{ asset('images/trash.png') }}" alt="削除" width="20" height="20">
                            </button>
                        </form>
                    </div>
                @endif
                <small>{{ $post->created_at->format('Y-m-d H:i') }}</small>
            </div>
        </div>
    @endforeach
</div>

<div class="modal-block" style="display: none;">
    <div class="modal-content" style="background: white; padding: 20px; border-radius: 10px; width: 300px; text-align: center;">
        <p class="modal-text">モーダルウィンドウ表示</p>
        <form id="edit-form">
            <!-- 投稿内容は後で追加 -->
        </form>
    </div>
</div>

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>


</x-login-layout>

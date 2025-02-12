<x-login-layout>

<div class="post">
    <div class="post-container">
     <!-- ログインユーザーのアイコン -->
     <div class="user-icon">
        @if(Auth::check() && Auth::user()->icon_image != 'icon1.png')
            <img src="{{ asset('storage/icons/' . Auth::user()->icon_image) }}" alt="User Icon" class="user-icon">
        @else
            <img src="{{ asset('/images/icon1.png') }}" alt="デフォルトアイコン" class="user-icon">
        @endif
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
                <!-- ユーザーアイコン -->
                @if($post->user->icon_image && $post->user->icon_image != 'icon1.png')
                <img src="{{ asset('storage/icons/' . $post->user->icon_image) }}" alt="User Icon" class="user-icon">
                @else
                <img src="{{ asset('/images/icon1.png') }}" alt="デフォルトアイコン" class="user-icon">
                @endif

            </div>
                <div class="post-content">
                    <h4 class="username">{{ $post->user->username }}</h4>
                    <p id="post-content-{{ $post->id }}">{{ $post->post }}</p>
                    @if (Auth::id() === $post->user_id)
                    <div class="post-actions">
                        <button type="button" class="modal-button" data-post="{{ $post->post }}" data-post-id="{{ $post->id }}">
                            <img src="{{ asset('images/edit.png') }}" alt="編集" width="20" height="20">
                        </button>
                        <form action="{{ route('posts.delete', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
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

<!-- モーダルウィンドウ中身 -->
<div class="modal-block" style="display: none;">
    <div class="modal-content" style="background: white; padding: 20px; border-radius: 10px; width: 300px; text-align: center;">
        <form id="edit-form" action="{{ route('posts.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')
                <textarea name="content" class="modal_post"></textarea>
                <input type="hidden" name="id" class="modal_id" value="">
                <input type="submit" value="更新">
                {{ csrf_field() }}
           </form>
    </div>
</div>


</x-login-layout>

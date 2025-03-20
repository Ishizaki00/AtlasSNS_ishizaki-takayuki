<x-login-layout>

<div class="post">
    <div class="post-container">
        <!-- エラーメッセージ -->
       @if ($errors->any())
    <div class="error-messages">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
        <textarea name="post" id="post" placeholder="投稿内容を入力してください。"></textarea>

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
                    <p id="post-content-{{ $post->id }}">{!! nl2br(e($post->post)) !!}</p>
                    @if (Auth::id() === $post->user_id)
                    <div class="post-actions">
                        <button type="button" class="modal-button" data-post="{{ $post->post }}" data-post-id="{{ $post->id }}">
                            <img src="{{ asset('images/edit.png') }}"  alt="編集" width="20" height="20">
                        </button>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
                                <img src="{{ asset('images/trash.png') }}" alt="削除" width="20" height="20">
                            </button>
                        </form>

                    </div>
                    @endif
                    <small class="post-date">{{ $post->created_at->format('Y-m-d H:i') }}</small>
                </div>
        </div>
    @endforeach
    </div>

<!-- モーダルウィンドウ中身 -->
<div class="modal-block" style="display: none;">
    <div class="modal-content" >
        <!-- <form id="edit-form" action="" method="POST">

                @csrf
                @method('PUT')
                <textarea name="content" class="modal_post"></textarea>
                <input type="hidden" name="id" class="modal_id" value="">
                <button type="submit" class="mdb">
                    <img src="{{ asset('/images/edit.png') }}" alt="更新" class="editcomp-button">
                </button>
                {{ csrf_field() }}
           </form> -->
           <form id="edit-form" action="" method="POST">
                @csrf
                @method('PUT')
                    <textarea name="post" class="modal_post"></textarea>
                    <input type="hidden" name="id" class="modal_id" value="">
                <button type="submit" class="mdb">
                    <img src="{{ asset('/images/edit.png') }}" alt="更新" class="editcomp-button">
                </button>
            </form>

    </div>
</div>


</x-login-layout>

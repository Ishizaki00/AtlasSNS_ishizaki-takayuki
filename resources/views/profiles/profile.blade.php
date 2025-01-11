<x-login-layout>
    <div class="profile-edit-container">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- ユーザー名 -->
             <div class="form-group">
        <label for="username" class="input-label">
            <img src="{{ asset('storage/icons/' . Auth::user()->icon_image) }}" alt="User Icon" class="user-icon">
            User Name
        </label>
        <input type="text" id="username" name="username" value="{{ Auth::user()->username }}" class="input-box">
    </div>

            <!-- メールアドレス -->
            <div class="form-group">
                <label for="email">mail address</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- パスワード -->
            <div class="form-group">
        <label for="password" class="input-label">Password</label>
        <input type="password" id="password" name="password" value="{{ old('password') }}" class="input-box">
    </div>

            <!-- パスワード確認 -->
            <div class="form-group">
        <label for="password_confirmation" class="input-label">Password Confirm</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="input-box">
    </div>

            <!-- Bio -->
            <div class="form-group">
                <label for="bio">bio</label>
                <textarea id="bio" name="bio" class="form-control">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <!-- アイコン画像 -->
            <div class="form-group">
                <label for="icon_image">icon image</label>
                <input type="file" id="icon_image" name="icon_image" class="form-control">
            </div>

            <!-- 更新ボタン -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">更新</button>
            </div>
        </form>
    </div>


</x-login-layout>

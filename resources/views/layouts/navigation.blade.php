<div id="head">
    <!-- トップページへのリンク -->
    <h1>
        <a href="{{ route('top') }}">
            <img src="/images/atlas.png" alt="Atlas" class="header-logo">
        </a>
    </h1>
    <div class="side_user">
        <div id="accordion" class="accordion-container">
            <button class="accordion-title" data-accordion-title>
                {{ Auth::user()->username }} さん
                <img class="arrow-icon" src="{{ asset('/images/arrow.svg') }}" alt="Arrow">
                <!-- アイコン画像を表示 -->
                @if(Auth::check() && Auth::user()->icon_image != 'icon1.png')
                <img src="{{ asset('storage/icons/' . Auth::user()->icon_image) }}" alt="User Icon" class="user-icon">
                @else
                <img src="{{ asset('/images/icon1.png') }}" alt="デフォルトアイコン" class="user-icon">
                @endif
            </button>
            <ul class="menu" style="display: none;">
                <li><a class="index" href="{{ route('top') }}">ホーム</a></li>
                <li><a class="profile" href="{{ route('profile.edit') }}">プロフィール</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; font: inherit;">
                        ログアウト
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</div>

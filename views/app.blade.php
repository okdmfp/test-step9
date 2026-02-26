<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cytech EC</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <a href="{{ route('products.index') }}">Cytech EC</a>
                <div>
                    <a href="{{ route('products.index') }}">Home</a>
                    @auth
                        <a href="{{ route('mypage') }}">マイページ</a>
                        <span>ログインユーザー: {{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit">ログアウト</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <main>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <a href="{{ route('products.index') }}">Home</a>
            <a href="{{ route('mypage') }}">マイページ</a>
            <a href="{{ route('contact.form') }}">お問い合わせ</a>
            <p>&copy; 2024 Company, Inc</p>
        </div>
    </footer>
</body>
</html>

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>アカウント情報編集</h2>
    
    <form method="POST" action="{{ route('account.update') }}">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name">ユーザ名</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="email">Eメール</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="name_kanji">名前</label>
            <input id="name_kanji" type="text" name="name_kanji" value="{{ old('name_kanji', $user->name_kanji) }}" required>
            @error('name_kanji')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="name_kana">カナ</label>
            <input id="name_kana" type="text" name="name_kana" value="{{ old('name_kana', $user->name_kana) }}">
            @error('name_kana')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="password">パスワード（変更する場合のみ）</label>
            <input id="password" type="password" name="password">
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="password_confirmation">パスワード確認</label>
            <input id="password_confirmation" type="password" name="password_confirmation">
        </div>
        
        <button type="submit">更新</button>
        <a href="{{ route('mypage') }}">戻る</a>
    </form>
</div>
@endsection

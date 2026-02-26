@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Register</h2>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div>
            <label for="name">Name（ユーザ名）</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="name_kanji">名前（漢字）</label>
            <input id="name_kanji" type="text" name="name_kanji" value="{{ old('name_kanji') }}" required>
            @error('name_kanji')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="name_kana">名前（カナ）</label>
            <input id="name_kana" type="text" name="name_kana" value="{{ old('name_kana') }}">
            @error('name_kana')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>
        
        <button type="submit">Register</button>
    </form>
</div>
@endsection
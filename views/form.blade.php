@extends('layouts.app')

@section('content')
<div class="container">
    <h2>お問い合わせフォーム</h2>
    
    <form method="POST" action="{{ route('contact.send') }}">
        @csrf
        
        <div>
            <label for="name">名前</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="message">お問い合わせ内容</label>
            <textarea id="message" name="message" required>{{ old('message') }}</textarea>
            @error('message')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <button type="submit">送信</button>
        <a href="{{ route('products.index') }}">戻る</a>
    </form>
</div>
@endsection
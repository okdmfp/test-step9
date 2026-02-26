@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Login</h2>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div>
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
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
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>
        </div>
        
        <button type="submit">Login</button>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>商品詳細</h2>
    
    <div>
        <p>商品名：{{ $product->product_name }}</p>
        <p>説明：{{ $product->description }}</p>
        
        @if($product->img_path)
            <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}">
        @endif
        
        <p>画像：</p>
        <p>金額：¥{{ number_format($product->price) }}</p>
        <p>会社：{{ $product->company->company_name }}</p>
        
        @auth
            <form action="{{ route('products.like', $product) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">{{ $is_liked ? '❤️' : '🤍' }}</button>
            </form>
            
            <form action="{{ route('products.purchase', $product) }}" method="POST">
                @csrf
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                <button type="submit">カートに追加する</button>
            </form>
        @endauth
        
        <a href="{{ route('products.index') }}">戻る</a>
    </div>
</div>
@endsection
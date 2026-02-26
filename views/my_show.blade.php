@extends('layouts.app')

@section('content')
<div class="container">
    <h2>出品商品詳細</h2>
    
    <div>
        <p>商品名：{{ $product->product_name }}</p>
        <p>説明：{{ $product->description }}</p>
        
        @if($product->img_path)
            <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}">
        @endif
        
        <p>金額：¥{{ number_format($product->price) }}</p>
        
        <a href="{{ route('products.edit', $product) }}">編集</a>
        
        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit">削除する</button>
        </form>
        
        <a href="{{ route('mypage') }}">戻る</a>
    </div>
</div>
@endsection
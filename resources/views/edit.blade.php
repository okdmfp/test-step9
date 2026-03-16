@extends('layouts.app')

@section('content')
<div class="container">
    <h2>出品商品編集</h2>
    
    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div>
            <label for="product_name">商品名</label>
            <!-- required を削除 -->
            <input id="product_name" type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}">
            @error('product_name')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="price">価格</label>
            <!-- required を削除 -->
            <input id="price" type="number" name="price" value="{{ old('price', $product->price) }}">
            @error('price')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="description">商品説明</label>
            <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="stock">在庫数</label>
            <!-- required を削除 -->
            <input id="stock" type="number" name="stock" value="{{ old('stock', $product->stock) }}">
            @error('stock')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="img_path">商品画像</label>
            @if($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" width="200">
            @endif
            <input id="img_path" type="file" name="img_path" accept="image/*">
            @error('img_path')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        
        <button type="submit">更新</button>
        <a href="{{ route('products.my.show', $product) }}">戻る</a>
    </form>
</div>
@endsection
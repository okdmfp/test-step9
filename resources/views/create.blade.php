@extends('layouts.app')

@section('content')
<div class="container">
    <h2>商品登録</h2>
    
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div>
            <label for="product_name">商品名</label>
            <input id="product_name" type="text" name="product_name" value="{{ old('product_name') }}" required>
            @error('product_name')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="price">価格</label>
            <input id="price" type="number" name="price" value="{{ old('price') }}" required>
            @error('price')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="description">商品説明</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="stock">在庫数</label>
            <input id="stock" type="number" name="stock" value="{{ old('stock') }}" required>
            @error('stock')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <label for="img_path">商品画像</label>
            <input id="img_path" type="file" name="img_path" accept="image/*">
            @error('img_path')
                <span>{{ $message }}</span>
            @enderror
        </div>
        
        <button type="submit">登録</button>
        <a href="{{ route('mypage') }}">戻る</a>
    </form>
</div>
@endsection
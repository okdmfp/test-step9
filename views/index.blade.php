@extends('layouts.app')

@section('content')
<div class="container">
    <h2>商品一覧</h2>
    
    <form method="GET" action="{{ route('products.index') }}">
        <input type="text" name="product_number" placeholder="商品番号を入力" value="{{ request('product_number') }}">
        
        <input type="number" name="min_price" placeholder="最低価格" value="{{ request('min_price') }}">
        <span>〜</span>
        <input type="number" name="max_price" placeholder="最高価格" value="{{ request('max_price') }}">
        
        <input type="number" name="min_stock" placeholder="最低在庫" value="{{ request('min_stock') }}">
        <span>〜</span>
        <input type="number" name="max_stock" placeholder="最高在庫" value="{{ request('max_stock') }}">
        
        <button type="submit">検索</button>
    </form>
    
    <table>
        <thead>
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>商品説明</th>
                <th>価格</th>
                <th>残り(¥)</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->description }}</td>
                <td>¥{{ number_format($product->price) }}</td>
                <td>{{ $product->stock }}</td>
                <td><a href="{{ route('products.show', $product) }}">詳細</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
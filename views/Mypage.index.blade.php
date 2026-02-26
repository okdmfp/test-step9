@extends('layouts.app')

@section('content')
<div class="container">
    <h2>マイページ</h2>
    
    <div>
        <a href="{{ route('account.edit') }}">アカウント編集</a>
        
        <p>ユーザ名：{{ $user->name }}</p>
        <p>Eメール：{{ $user->email }}</p>
        <p>名前：{{ $user->name_kanji }}</p>
        <p>カナ：{{ $user->name_kana }}</p>
    </div>
    
    <h3>＜出品商品＞</h3>
    <a href="{{ route('products.create') }}">新規登録</a>
    
    <table>
        <thead>
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>商品説明</th>
                <th>料金(¥)</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach($my_products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->description }}</td>
                <td>¥{{ number_format($product->price) }}</td>
                <td><a href="{{ route('products.my.show', $product) }}">詳細</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <h3>＜購入した商品＞</h3>
    <table>
        <thead>
            <tr>
                <th>商品名</th>
                <th>商品説明</th>
                <th>料金(¥)</th>
                <th>個数</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchased_products as $item)
            <tr>
                <td>{{ $item['product']->product_name }}</td>
                <td>{{ $item['product']->description }}</td>
                <td>¥{{ number_format($item['product']->price) }}</td>
                <td>{{ $item['total_quantity'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

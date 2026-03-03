<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products.index');
});

// 認証関連
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// 商品一覧・詳細（ログイン不要）
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

// お問い合わせ（ログイン不要）
Route::get('contact', [ContactController::class, 'show'])->name('contact.form');
Route::post('contact', [ContactController::class, 'send'])->name('contact.send');

// 認証必須
Route::middleware('auth')->group(function () {
    // マイページ
    Route::get('mypage', [MypageController::class, 'index'])->name('mypage');
    
    // アカウント編集
    Route::get('account/edit', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('account', [AccountController::class, 'update'])->name('account.update');
    
    // 商品登録・編集・削除
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}/my', [ProductController::class, 'showMyProduct'])->name('products.my.show');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    // 購入
    Route::post('products/{product}/purchase', [ProductController::class, 'purchase'])->name('products.purchase');
    
    // いいね
    Route::post('products/{product}/like', [LikeController::class, 'toggle'])->name('products.like');
});

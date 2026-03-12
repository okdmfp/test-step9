<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest; // フォームリクエストの読み込み
use App\Http\Requests\UpdateProductRequest; // フォームリクエストの読み込み
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // ログ用
use Exception; // try-catch用

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['company', 'user']);

        if ($request->filled('product_number')) {
            $query->where('id', $request->product_number);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('min_stock')) {
            $query->where('stock', '>=', $request->min_stock);
        }

        if ($request->filled('max_stock')) {
            $query->where('stock', '<=', $request->max_stock);
        }

        if (auth()->check()) {
            $products = $query->where('user_id', '!=', auth()->id())->get();
        } else {
            $products = $query->get();
        }

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load(['company', 'user']);
        $is_liked = auth()->check() ? $product->isLikedBy(auth()->user()) : false;
        
        return view('products.show', compact('product', 'is_liked'));
    }

    public function create()
    {
        return view('products.create');
    }

    // ★修正箇所: StoreProductRequest を使用し、try-catchを追加
    public function store(StoreProductRequest $request)
    {
        try {
            // FormRequestでバリデーション済みのデータを取得
            $validated = $request->validated();

            $img_path = null;
            if ($request->hasFile('img_path')) {
                $img_path = $request->file('img_path')->store('products', 'public');
            }

            Product::create([
                'user_id' => auth()->id(),
                'company_id' => auth()->user()->company_id,
                'product_name' => $validated['product_name'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'stock' => $validated['stock'],
                'img_path' => $img_path,
            ]);

            return redirect()->route('mypage')->with('success', '商品を登録しました。');

        } catch (Exception $e) {
            Log::error('商品登録エラー: ' . $e->getMessage());
            return back()->with('error', '商品の登録に失敗しました。')->withInput();
        }
    }

    public function showMyProduct(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        return view('products.my_show', compact('product'));
    }

    public function edit(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        return view('products.edit', compact('product'));
    }

    // ★修正箇所: UpdateProductRequest を使用し、try-catchを追加
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            // FormRequestのauthorizeで所有者チェックを行っている前提
            $validated = $request->validated();

            if ($request->hasFile('img_path')) {
                if ($product->img_path) {
                    Storage::disk('public')->delete($product->img_path);
                }
                $validated['img_path'] = $request->file('img_path')->store('products', 'public');
            }

            $product->update($validated);

            return redirect()->route('products.my.show', $product)->with('success', '商品を更新しました。');

        } catch (Exception $e) {
            Log::error('商品更新エラー: ' . $e->getMessage());
            return back()->with('error', '商品の更新に失敗しました。')->withInput();
        }
    }

    // ★修正箇所: try-catchを追加
    public function destroy(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            if ($product->img_path) {
                Storage::disk('public')->delete($product->img_path);
            }

            $product->delete();

            return redirect()->route('mypage')->with('success', '商品を削除しました。');

        } catch (Exception $e) {
            Log::error('商品削除エラー: ' . $e->getMessage());
            return back()->with('error', '商品の削除に失敗しました。');
        }
    }

    // ★購入処理にもtry-catchを追加（トランザクション制御も入れるとより安全です）
    public function purchase(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($product->stock < $validated['quantity']) {
            return back()->with('error', '在庫が不足しています。');
        }

        try {
            $product->decrement('stock', $validated['quantity']);

            $product->sales()->create([
                'user_id' => auth()->id(),
                'quantity' => $validated['quantity'],
            ]);

            return redirect()->route('products.show', $product)->with('success', '購入しました。');

        } catch (Exception $e) {
            Log::error('商品購入エラー: ' . $e->getMessage());
            return back()->with('error', '商品の購入に失敗しました。');
        }
    }
}

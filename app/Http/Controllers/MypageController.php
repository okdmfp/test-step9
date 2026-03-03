<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('company');
        
        $my_products = $user->products()
            ->orderBy('id')
            ->get();
        
        $purchased_products = $user->sales()
            ->with('product')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('product_id')
            ->map(function ($sales) {
                return [
                    'product' => $sales->first()->product,
                    'total_quantity' => $sales->sum('quantity'),
                ];
            });

        return view('mypage.index', compact('user', 'my_products', 'purchased_products'));
    }
}
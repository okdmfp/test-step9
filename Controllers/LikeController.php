<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Product $product)
    {
        $user = auth()->user();

        if ($user->likedProducts()->where('product_id', $product->id)->exists()) {
            $user->likedProducts()->detach($product->id);
            $is_liked = false;
        } else {
            $user->likedProducts()->attach($product->id);
            $is_liked = true;
        }

        return back()->with('is_liked', $is_liked);
    }
}

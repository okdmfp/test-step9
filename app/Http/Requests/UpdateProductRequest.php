<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('product')->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'product_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'stock' => ['required', 'integer', 'min:0'],
            'img_path' => ['nullable', 'image', 'max:2048'],
        ];
    }

    // ★追加：エラーメッセージのカスタマイズ
    public function messages(): array
    {
        return [
            'product_name.required' => '商品名は必須です。',
            'product_name.string'   => '商品名は文字列で入力してください。',
            'product_name.max'      => '商品名は255文字以内で入力してください。',
            
            'price.required' => '価格は必須です。',
            'price.integer'  => '価格は数値で入力してください。',
            'price.min'      => '価格は0以上で入力してください。',
            
            'description.string' => '商品説明は文字列で入力してください。',
            
            'stock.required' => '在庫数は必須です。',
            'stock.integer'  => '在庫数は数値で入力してください。',
            'stock.min'      => '在庫数は0以上で入力してください。',
            
            'img_path.image' => '商品画像には画像ファイルを指定してください。',
            'img_path.max'   => '商品画像は2MB以下のファイルにしてください。',
        ];
    }
}

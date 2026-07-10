<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',

            'crop_year' => [
                'required',
                'integer',
                'min:2000',
                Rule::unique('product_stocks', 'crop_year')
                    ->where(function ($query) {
                        return $query->where(
                            'product_id',
                            $this->input('product_id')
                        );
                    })
                    ->ignore($this->route('product_stock')),
            ],

            'stock_5kg' => 'required|integer|min:0',
            'stock_10kg' => 'required|integer|min:0',
            'stock_20kg' => 'required|integer|min:0',
            'stock_30kg' => 'required|integer|min:0',
        ];
    }
    public function attributes(): array
    {
        return [
            'product_id' => '品種',
            'crop_year' => '年産',
            'stock_5kg' => '5kg在庫',
            'stock_10kg' => '10kg在庫',
            'stock_20kg' => '20kg在庫',
            'stock_30kg' => '30kg在庫',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attributeは入力必須です。',
            '*.integer' => ':attributeは数値で入力してください。',
            '*.min' => ':attributeは:min以上で入力してください。',
            '*.exists' => '選択された:attributeが存在しません。',
            'crop_year.unique' => 'この品種・年産の在庫はすでに登録されています。',
        ];
    }
}

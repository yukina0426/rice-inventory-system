<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'variety' => [
                'required',
                'string',
                'max:100',
                Rule::unique('products', 'variety')
                    ->ignore($this->route('product')),
            ],
            'price_5kg' => 'required|integer|min:0',
            'price_10kg' => 'required|integer|min:0',
            'price_20kg' => 'required|integer|min:0',
            'price_30kg' => 'required|integer|min:0',
        ];
    }

    public function attributes(): array
    {
        return [
            'variety' => '品種',
            'price_5kg' => '5kg価格',
            'price_10kg' => '10kg価格',
            'price_20kg' => '20kg価格',
            'price_30kg' => '30kg価格',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attributeは入力必須です。',
            '*.max' => ':attributeは:max文字以内で入力してください。',
            '*.integer' => ':attributeは数値で入力してください。',
            '*.min' => ':attributeは:min以上で入力してください。',
            'variety.unique' => 'この品種はすでに登録されています。',
        ];
    }
}

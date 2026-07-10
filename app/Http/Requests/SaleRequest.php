<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaleRequest extends FormRequest
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
            'product_stock_id' => [
                'required',
                'integer',
                'exists:product_stocks,id',
            ],
            'sale_date' => [
                'required',
                'date',
            ],
            'customer_name' => [
                'required',
                'string',
                'max:100',
            ],
            'size' => [
                'required',
                Rule::in(['5kg', '10kg', '20kg', '30kg']),
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
            'sale_method' => [
                'required',
                'string',
                'max:50',
            ],
            'note' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'product_stock_id' => '商品・収穫年度',
            'sale_date' => '販売日',
            'customer_name' => '顧客名',
            'size' => '商品サイズ',
            'quantity' => '販売数量',
            'sale_method' => '販売方法',
            'note' => '備考',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attributeは入力必須です。',
            '*.integer' => ':attributeは整数で入力してください。',
            '*.min' => ':attributeは:min以上で入力してください。',
            '*.max' => ':attributeは:max文字以内で入力してください。',
            '*.string' => ':attributeは文字列で入力してください。',
            '*.date' => ':attributeは正しい日付で入力してください。',
            '*.exists' => '選択された:attributeが存在しません。',
            'size.in' => ':attributeは5kg、10kg、20kg、30kgのいずれかを選択してください。',
        ];
    }
}

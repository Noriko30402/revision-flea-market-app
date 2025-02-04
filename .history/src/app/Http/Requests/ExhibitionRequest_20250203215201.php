<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category' => 'required',
            'condition_id' => 'required',
            'product_name' => 'required',
            'description' => 'required|max:255',
            'price' => 'required|min:0||numeric',
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'カテゴリーを選択してください',
            'condition_id.required' => '商品の状態を選択してください',
            'product_name.required' => '商品名を入力してください。',
            'description.required' => '説明を入力してください。',
            'price.required' => '金額を入力してください',
        ];
    }

}

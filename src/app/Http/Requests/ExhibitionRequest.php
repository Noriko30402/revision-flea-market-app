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
            'categories' => 'required',
            'condition_id' => 'required',
            'item_name' => 'required',
            'description' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|mimes:jpeg,png',
            'brand' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'categories.required' => 'カテゴリーを選択してください',
            'condition_id.required' => '商品の状態を選択してください',
            'item_name.required' => '商品名を入力してください。',
            'description.required' => '説明を入力してください。',
            'description.max' => "255文字以内で入力してください",
            'price.required' => '金額を入力してください',
            'price.numeric' => '数字を入力してください',
            'image.required'=> '画像をアップロードしてください',
            'image.mimes' =>  '画像の拡張子はjpegまたはpngでなければなりません。',
            'brand.required' => 'ブランド名を入力してください',

        ];
    }

}

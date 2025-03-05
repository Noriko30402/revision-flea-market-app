<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'image' => 'mimes:jpeg,png',
            'postcode' => ['required','regex:/^\d{3}-\d{4}$/'],
            'address' => 'required',
            'building' =>'required',
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.mimes' =>  '画像の拡張子はjpegまたはpngでなければなりません。',
            'postcode.required' => '郵便番号を入力してください',
            'postcode.regex'=>'郵便番号はハイフンありの８文字で入力してください',
            'address.required' => '住所を入力してください',
            'building.required' =>'建物名を入力してください',
            'name.required' => 'お名前を入力してください'
        ];
    }

}

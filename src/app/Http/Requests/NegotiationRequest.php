<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NegotiationRequest extends FormRequest
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
            'img_url' => 'mimes:jpeg,png',
            'content' => 'required|max:400',

        ];
    }

        public function messages()
    {
        return [
            'content.required' => '本文を入力してください。',
            'content.max' => '本文は400文字以内で入力してください',
            'img_url.mimes' => '「jpeg」または「png」形式でアップロードしてください。',
        ];
    }
}

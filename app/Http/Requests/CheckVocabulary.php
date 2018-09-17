<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CheckVocabulary extends Request
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
            'txtVocabulary' => 'required'
        ];
    }

    public function messages(){
        return [
            'txtVocabulary.required' => 'Bạn vui lòng nhập gì đó vào chỗ trống.'
        ];
    }
}

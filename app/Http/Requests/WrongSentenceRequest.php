<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WrongSentenceRequest extends Request
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
            'txtwrong' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'txtwrong.required' => 'Bạn hãy nhập câu tiếng anh mà nghĩ là đúng nhé'
        ];
    }
}

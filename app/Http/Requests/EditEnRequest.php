<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditEnRequest extends Request
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
            'txtEditEn' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'txtEditEn.required' => 'Bạn vui lòng nhập bản English muốn sửa'
        ];
    }

}

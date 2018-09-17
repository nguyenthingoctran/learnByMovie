<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditProfileRequest extends Request
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
            'txtpass' => 'same:txtrepass',
            'txtrepass' => 'same:txtpass'
        ];
    }

    public function messages(){
        return [
            'txtpass.same' => 'Mật khẩu và nhập lại mật khẩu không trùng nhau',
            'txtrepass.same' => 'Mật khẩu và nhập lại mật khẩu không trùng nhau',
        ];
    }
}

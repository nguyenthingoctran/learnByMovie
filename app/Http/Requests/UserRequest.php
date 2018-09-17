<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            'txtname' => 'required|unique:users,name',
            'txtemail' => 'required',
            'txtpass' => 'required',
            'txtrepass' => 'required|same:txtpass',
            'myFile' => 'mimes:png,jpg,jpeg,bmp'
        ];
    }

    public function messages(){
        return[
            'txtname.required' => 'Bạn chưa nhập tên người dùng',
            'txtname.unique' => 'Tên truy cập này đã tồn tại',
            'txtemail.required' => 'Bạn chưa nhập email',
            'txtpass.required' => 'Bạn chưa nhập mật khẩu',
            'txtrepass.required' => 'Mời nhập lại mật khẩu',
            'txtrepass.same' => 'Nhập lại mật khẩu không đúng',
            'myFile.mimes' => 'Bạn vui lòng chọn file hình ảnh (png,jpg,jpeg,bmp)'
        ];
    }
}

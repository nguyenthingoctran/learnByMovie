<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FilmRequest extends Request
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
            'chooseKind' => 'exists:kinds,kind_id',
            'txtname' => 'required',
            'myFile' => 'required|mimes:png,jpg,jpeg,bmp',
            'ckeditor' => 'required'
        ];
    }

    public function messages(){
        return[
            'chooseKind.exists' => 'Bạn chưa chọn thể loại nào cả',
            'txtname.required' => 'Bạn chưa nhập tên phim',
            'myFile.mimes' =>'Bạn chỉ chọn file có đuôi png,jpg,jpeg,bmp thôi nhé',
            'myFile.required' =>'Bạn chưa chọn ảnh poster cho phim',
            'ckeditor.required' => 'Bạn chưa thêm văn bản Tiếng Anh'
        ];
    }
}

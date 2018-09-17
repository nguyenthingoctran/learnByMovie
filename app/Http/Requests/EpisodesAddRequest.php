<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EpisodesAddRequest extends Request
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
            'name_ep' => 'required|numeric',
            'myFile' => 'required|mimes:png,jpg,jpeg,bmp',
            'myVideo' => 'required|mimes:m4v,avi,flv,mp4,mov,wmv,mkv'
        ];
    }

    public function messages(){
        return[
            'name_ep.required' => 'Bạn chưa nhập tập phim',
            'name_ep.numeric' => 'Bạn vui lòng nhập số',
            'myFile.required' => 'Bạn chưa chọn hình nào cả',
            'myFile.mimes' => 'Bạn vui lòng chọn file có định dạng png,jpg,jpeg,bmp',
            'myVideo.required' => 'Bạn chưa chọn video nào cả',
            'myVideo.mimes' => 'Bạn vui lòng chọn file có định dạng m4v,avi,flv,mp4,mov,wmv,mkv'
        ];
    }
}

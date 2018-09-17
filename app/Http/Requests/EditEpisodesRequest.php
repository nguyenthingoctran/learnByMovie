<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditEpisodesRequest extends Request
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
            'name_ep' => 'required',
            'myFile' => 'mimes:png,jpg,jpeg,bmp',
            'myVideo' => 'mimes:m4v,avi,flv,mp4,mov,wmv'
            ];
    }
    public function messages(){
        return [
            'name_ep.required' => 'Bạn chưa nhập tập mấy',
            'myFile.mimes' => 'Bạn vui lòng chọn file có định dạng png,jpg,jpeg,bmp',
            'myVideo.mimes' => 'Bạn vui lòng chọn file có định dạng m4v,avi,flv,mp4,mov,wmv'
        ];
    }
}

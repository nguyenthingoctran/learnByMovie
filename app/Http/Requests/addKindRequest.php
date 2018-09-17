<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class addKindRequest extends Request
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
            'txtname' => 'required|unique:kinds,kind_name'
        ];
    }

    public function messages()
    {
        return [
            'txtname.required' => 'Bạn chưa nhập tên thể loại.',
            'txtname.unique' => 'Thể loại này đã có.'
        ];
    }}

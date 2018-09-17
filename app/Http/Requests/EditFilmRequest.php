<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class EditFilmRequest extends Request
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
            'txtname' =>'required',
            'chooseKind' => 'exists:kinds,kind_id',
        ];
    }

    public function messages(){
        return[
            'txtname.required' => 'Bạn chưa nhập tên phim',
            'txtname.unique' => 'Tên phim đã tồn tại',
            'chooseKind.exists' => 'Bạn chưa chọn thể loại nào cả',
        ];
    } 
}

<?php

namespace App\Http\Requests;

use App\Classes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditClassRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'txtEditClassName' => 'required|digits:6|numeric|unique:classes,name,'.$request->txtEditClassName,
            'slEditClassScienceId' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'txtEditClassName.unique' => 'Tên lớp học đã tồn tại.',
            'txtEditClassName.numeric' => 'Tên lớp học chỉ nên là chữ số.',
            'txtEditClassName.required' => 'Vui lòng điền tên lớp học.',
            'txtEditClassName.digits' => 'Tên lớp học quá dài (nên là 6 chữ số).',
            'slEditClassScienceId.required' => 'Vui lòng chọn khóa học.'
        ];
    }
}

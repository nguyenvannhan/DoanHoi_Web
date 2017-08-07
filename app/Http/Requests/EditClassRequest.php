<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        return [
            'txtEditClassName' => 'unique:classes,nameClass,.|required|max:6|numeric',
            'slEditScienceId' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'txtEditClassName.unique' => 'Tên lớp học đã tồn tại.',
            'txtEditClassName.numeric' => 'Tên lớp học chỉ nên là chữ số.',
            'txtEditClassName.required' => 'Vui lòng điền tên lớp học.',
            'txtEditClassName.max' => 'Tên lớp học quá dài (nên là 6 chữ số).',
            'slEditScienceId.required' => 'Vui lòng chọn khóa học.'
        ];
    }
}

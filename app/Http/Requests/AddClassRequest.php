<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AddClassRequest extends FormRequest
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
            'txtAddClassName' => 'required|unique:classes,nameClass|digits:6|numeric',
            'slAddScienceId' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'txtAddClassName.required' => 'Vui lòng nhập tên Khóa học.',
            'txtAddClassName.unique' => 'Lớp học đã tồn tại.',
            'txtAddClassName.digits' => 'Tên lớp học quá dài (nên là 6 chữ số).',
            'txtAddClassName.numeric' => 'Tên lớp học chỉ nên là chữ số.',
            'slAddScienceId.required' => 'Vui lòng chọn Khóa học.'
        ];
    }
}

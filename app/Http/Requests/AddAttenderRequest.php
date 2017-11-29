<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAttenderRequest extends FormRequest
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
            'id' => 'required',
            'name' => 'required',
            'science_id' => 'required',
            'faculty_id' => 'required',
            'class_id' => 'required_if:faculty_id,1',
            'email' => 'nullable|email',
            'numberphone' => 'alpha_num|nullable'
        ];
    }

    public function messages() {
        return [
            'id.required' => 'Điền MSSV',
            'name.required' => 'Tên sinh viên',
            'science_id.required' => 'Chọn khóa học',
            'faculty_id.required' => 'Chọn Khoa',
            'class_id.required_if' => 'Chọn lớp học.',
            'email.email' => 'Email không đúng',
            'numberphone.alpha_num' => 'SĐT không đúng'
        ];
    }
}

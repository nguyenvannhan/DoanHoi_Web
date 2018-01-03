<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditStudentRequest extends FormRequest
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
            'name' => 'required|string',
            'birthday' => 'date_format:d/m/Y|nullable',
            'hometown' => 'nullable|string',
            'email' => 'nullable|email',
            'numberphone' => 'nullable|alpha_num|max:11|min:10',
            'science_id' => 'required',
            'faculty_id' => 'required_if:is_it_student,0',
            'class_id' => 'required_if:is_it_student,1'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Nhập tên sinh viên',
            'name.string' => 'Tên sinh viên không đúng.',
            'name.size' => 'Tên sinh viên quá dài.',
            'birthday.date_format' => 'Ngày sinh không đúng (dd/mm/yyyy).',
            'hometown.string' => 'Quê quán không đúng.',
            'email.email' => 'Không đúng định dạng email.',
            'numberphone.alpha_num' => 'SĐT không đúng.',
            'numberphone.max' => 'SĐT không đúng',
            'numberphone.min' => 'SĐT không đúng.',
            'science_id.required' => 'Chọn khóa học.',
            'faculty_id.required_if' => 'Chọn khoa.',
            'class_id.required_if' => 'Chọn lớp học.'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddActivityRequest extends FormRequest
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
            'leader_id' => 'required|exists:students,id|size:8|string',
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y|after_or_equal:start_date',
            'start_regis_date' => 'required|date_format:d/m/Y|before_or_equal:end_regis_date',
            'end_regis_date' => 'required|date_format:d/m/Y|before_or_equal:start_date',
            'schoolyear_id' => 'required|numeric|exists:school_years,id',
            'conduct_mark' => 'required|integer|min:0',
            'social_mark' => 'required|integer|min:0',
            'activity_level' => 'required|integer|between:0,2',
            'class_id' => 'required_if:activity_level,0|nullable|exists:classes,id',
            'max_number' => 'integer|nullable',
            'trailer' => 'url|nullable'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Vui lòng điền Tên hoạt động',

            'leader_id.required' => 'Vui lòng điền MSSV người đứng chính',
            'leader_id.exists' => 'Thông tin người đứng chính không đúng',
            'leader_id.size' => 'Thông tin Người đứng chính không đúng',
            'leader_id.string' => 'Thông tin người đứng chính không đúng',

            'start_date.required' => 'Vui lòng chọn ngày bắt đầu hoạt động',
            'start_date.date_format' => 'Định dạng ngày bắt đầu hoạt động sai',

            'end_date.required' => 'Vui lòng chọn ngày kết thúc hoạt động',
            'end_date.date_format' => 'Định dạng ngày kết thúc hoạt động sai',
            'end_date.after_or_equal' => 'Ngày kết thúc hoạt động phải sau hoặc bằng  ngày bắt đầu',

            'start_regis_date.required' => 'Vui lòng chọn ngày bắt đầu đăng ký',
            'start_regis_date.date_format' => 'Định dạng ngày bắt đầu đăng ký không đúng',
            'start_regis_date.before_or_equal' => 'Ngày bắt đầu đăng ký phải nhỏ hơn hoặc bằng ngày kết thúc đăng ký',

            'end_regis_date.required' => 'Vui lòng chọn ngày kết thúc đăng ký.',
            'end_regis_date.date_format' => 'Định dạng ngày kết thúc đăng ký sai.',
            'end_regis_date.before_or_equal' => 'Ngày kết thúc đăng ký phải trước hoặc giống ngày bắt đầu hoạt động.',

            'schoolyear_id.required' => 'Vui lòng chọn năm học.',
            'schoolyear_id.numeric' => 'Giá trị năm học không đúng.',
            'schoolyear_id.exists' => 'Năm học không tồn tại.',

            'conduct_mark.required' =>'Vui lòng nhập Điểm rèn luyện. (Tối thiểu: 0)',
            'conduct_mark.integer' =>'Điểm rèn luyện phải là số.',
            'conduct_mark.min' =>'Điểm rèn luyện có giá trị tối thiểu là 0.',

            'social_mark.required' =>'Vui lòng nhập điểm CTXH.',
            'social_mark.integer' =>'Điểm CTXH phải là số.',
            'social_mark.min' =>'Điểm CTXH có giá trị tối thiểu là 0.',

            'activity_level.required' =>'Vui lòng chọn cấp hoạt động.',
            'activity_level.integer' =>'Cấp hoạt động được chọn không đúng.',
            'activity_level.between' =>'Cấp hoạt động được chọn không đúng.',

            'class_id.required_if' => 'Vui lòng điền tên lớp.',
            'class_id.exists' => 'Tên lớp không tồn tại.',

            'max_number.integer' => 'Số lượng tối đa tham gia phải là số.',

            'trailer.url' => 'Link video trailer không đúng.',
        ];
    }
}

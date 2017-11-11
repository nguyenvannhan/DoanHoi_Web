<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditActivityRequest extends FormRequest
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
            'txtActivityName' => 'required|string',
            'txtHiddenActivityLeader' => 'required|exists:studentes,mssv|size:8|string',
            'dtpStartDate' => 'required|date_format:d/m/Y',
            'dtpEndDate' => 'required|date_format:d/m/Y|after_or_equal:dtpStartDate',
            'dtpStartRegisDate' => 'required|date_format:d/m/Y|before_or_equal:dtpEndRegisDate',
            'dtpEndRegisDate' => 'required|date_format:d/m/Y|before_or_equal:dtpStartDate',
            'slSchoolYear' => 'required|numeric|exists:school_yeares,id',
            'txtConductMark' => 'required|integer|min:0',
            'txtSocialMark' => 'required|integer|min:0',
            'rdActivityLevel' => 'required|integer|between:0,2',
            'txtClassId' => 'required_if:rdActivityLevel,0|nullable|exists:classes,id',
            'txtMaxNumber' => 'integer|nullable',
            'txtTrailerURL' => 'url|nullable'
        ];
    }

    public function messages() {
        return [
            'txtActivityName.required' => 'Vui lòng điền Tên hoạt động',

            'txtHiddenActivityLeader.required' => 'Vui lòng điền MSSV người đứng chính',
            'txtHiddenActivityLeader.exists' => 'Thông tin người đứng chính không đúng',
            'txtHiddenActivityLeader.size' => 'Thông tin Người đứng chính không đúng',
            'txtHiddenActivityLeader.string' => 'Thông tin người đứng chính không đúng',

            'dtpStartDate.required' => 'Vui lòng chọn ngày bắt đầu hoạt động',
            'dtpStartDate.date_format' => 'Định dạng ngày bắt đầu hoạt động sai',

            'dtpEndDate.required' => 'Vui lòng chọn ngày kết thúc hoạt động',
            'dtpEndDate.date_format' => 'Định dạng ngày kết thúc hoạt động sai',
            'dtpEndDate.after_or_equal' => 'Ngày kết thúc hoạt động phải sau hoặc bằng  ngày bắt đầu',

            'dtpStartRegisDate.required' => 'Vui lòng chọn ngày bắt đầu đăng ký',
            'dtpStartRegisDate.date_format' => 'Định dạng ngày bắt đầu đăng ký không đúng',
            'dtpStartRegisDate.before_or_equal' => 'Ngày bắt đầu đăng ký phải nhỏ hơn hoặc bằng ngày kết thúc đăng ký',

            'dtpEndRegisDate.required' => 'Vui lòng chọn ngày kết thúc đăng ký.',
            'dtpEndRegisDate.date_format' => 'Định dạng ngày kết thúc đăng ký sai.',
            'dtpEndRegisDate.before_or_equal' => 'Ngày kết thúc đăng ký phải trước hoặc giống ngày bắt đầu hoạt động.',

            'slSchoolYear.required' => 'Vui lòng chọn năm học.',
            'slSchoolYear.numeric' => 'Giá trị năm học không đúng.',
            'slSchoolYear.exists' => 'Năm học không tồn tại.',

            'txtConductMark.required' =>'Vui lòng nhập Điểm rèn luyện. (Tối thiểu: 0)',
            'txtConductMark.integer' =>'Điểm rèn luyện phải là số.',
            'txtConductMark.min' =>'Điểm rèn luyện có giá trị tối thiểu là 0.',

            'txtSocialMark.required' =>'Vui lòng nhập điểm CTXH.',
            'txtSocialMark.integer' =>'Điểm CTXH phải là số.',
            'txtSocialMark.min' =>'Điểm CTXH có giá trị tối thiểu là 0.',

            'rdActivityLevel.required' =>'Vui lòng chọn cấp hoạt động.',
            'rdActivityLevel.integer' =>'Cấp hoạt động được chọn không đúng.',
            'rdActivityLevel.between' =>'Cấp hoạt động được chọn không đúng.',

            'txtClassId.required_if' => 'Vui lòng điền tên lớp.',
            'txtClassId.exists' => 'Tên lớp không tồn tại.',

            'txtMaxNumber.integer' => 'Số lượng tối đa tham gia phải là số.',

            'txtTrailerURL.url' => 'Link video trailer không đúng.',
        ];
    }
}

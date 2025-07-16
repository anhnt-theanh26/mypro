<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required|string|max:255',
            'new_password' => 'required|string|min:3|max:255',
            'confirm_password' => 'required|same:new_password',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ.',
            'old_password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'old_password.max' => 'Mật khẩu phải ít hơn 255 ký tự.',

            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'new_password.min' => 'Mật khẩu phải có ít nhất 3 ký tự.',
            'new_password.max' => 'Mật khẩu phải ít hơn 255 ký tự.',

            'confirm_password.required' => 'Vui lòng nhập mật khẩu xác nhận.',
            'confirm_password.same' => 'Xác nhận mật khẩu phải giống với mật khẩu mới.',
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}

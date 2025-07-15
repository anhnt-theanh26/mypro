<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|max:255',
            'image' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được để trống!',
            'name.max' => 'Tên danh mục không được lớn hơn 255 ký tự!',
            'slug.max' => 'Tên danh mục không được dài hơn 255 ký tự!',
            'slug.unique' => 'Tên danh mục đã tồn tại!',
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

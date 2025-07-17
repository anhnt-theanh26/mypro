<?php

namespace Modules\Album\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlumRequest extends FormRequest
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
            'slug' => 'nullable|max:255|unique:albums,slug',
            'artist' => 'required|string|max:255',
            'thumbnail' => 'nullable|max:255',
            'release_date' => 'nullable|date',
            // 'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên album không được để trống!',
            'name.max' => 'Tên album không được lớn hơn 255 ký tự!',

            'slug.max' => 'Tên album không được dài hơn 255 ký tự!',
            'slug.unique' => 'Tên album đã tồn tại!',

            'artist.required' => 'Tên artist không được để trống!',
            'artist.max' => 'Tên artist không được lớn hơn 255 ký tự!',

            'thumbnail.max' => 'Thumbnail không được lớn hơn 255 ký tự!',

            'release_date.date' => 'Ngày phát hành không đúng định dạng ngày tháng.',

            // 'category_id.required' => 'Danh mục không được để trống!',
            // 'category_id.exists' => 'Danh mục không hợp lệ!',
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

<?php

namespace Modules\Song\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSongRequest extends FormRequest
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
            'album_id' => 'nullable|exists:albums,id',
            'cover_art' => 'nullable|max:255',
            'file_path' => 'nullable|max:255',
            'duration' => 'nullable|numeric',
            'release_date' => 'required|date',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên album là bắt buộc.',
            'name.string' => 'Tên album phải là một chuỗi ký tự.',
            'name.max' => 'Tên album không được vượt quá 255 ký tự.',

            'slug.max' => 'Tên album không được dài hơn 255 ký tự!',
            'slug.unique' => 'Tên album đã tồn tại!',

            'artist.required' => 'Tên nghệ sĩ là bắt buộc.',
            'artist.string' => 'Tên nghệ sĩ phải là một chuỗi ký tự.',
            'artist.max' => 'Tên nghệ sĩ không được vượt quá 255 ký tự.',

            'album_id.exists' => 'Album không tồn tại trong hệ thống.',

            'cover_art.max' => 'Ảnh bìa không được vượt quá 255 ký tự.',

            'file_path.max' => 'Đường dẫn tệp không được vượt quá 255 ký tự.',

            'duration.numeric' => 'Thời gian phải là một số hợp lệ.',

            'release_date.required' => 'Ngày phát hành là bắt buộc.',
            'release_date.date' => 'Ngày phát hành không hợp lệ.',

            'category_id.exists' => 'Danh mục không tồn tại.',
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
            'name' => 'bail|required|unique:products|max:255|min:2',
            'description' => 'required',
            'image_path' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được phép để trống',
            'name.unique' => 'Tên không được trùng',
            'name.max'  => 'Tên không được phép quá 255 ký tự',
            'name.min' => 'Tên không được ít hơn 2 ký tự',
            'description.required' => 'Không được để rỗng',
            'image_path' => 'Không được để trống'
        ];
    }
}

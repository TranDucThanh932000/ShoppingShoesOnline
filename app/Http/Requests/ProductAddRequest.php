<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'price' => 'required',
            'parent_id' => 'required',
            'content' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được phép để trống',
            'name.unique' => 'Tên không được trùng',
            'name.max'  => 'Tên không được phép quá 255 ký tự',
            'name.min' => 'Tên không được phép nhỏ hơn 2 ký tự',
            'price.required' => 'Giá không được để trống',
            'parent_id.required' => 'Không thể để trống',
            'content.required' => 'Nội dung không thể để trống'
        ];
    }
}

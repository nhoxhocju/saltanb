<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'title-en' => 'required|unique:post_language,title|min:1|max:100',
            'title-kr' => 'required|unique:post_language,title|string|min:1|max:100',
            'content-en' => 'required|string|min:1|max:5000',
            'content-kr' => 'required|string|min:1|max:5000',
            'category_id' => 'required|nullable',
        ];
    }
}

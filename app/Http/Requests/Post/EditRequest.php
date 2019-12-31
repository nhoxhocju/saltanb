<?php

namespace App\Http\Requests\Post;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
    public function rules(Request $request)
    {
        // $post = find($)
        // $post = Post::find($request->route('id'));
        // $posts 
        $id = $request->route('id');

        return [
            'title-en' => "required|unique:post_language,title, $id,post_id|string|min:1|max:100",
            'title-kr' => "required|unique:post_language,title, $id,post_id|string|min:1|max:100",
            'content-en' => 'required|string|min:1|max:5000',
            'content-kr' => 'required|string|min:1|max:5000',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|min:3|max:255|unique:posts,slug,'.$this->post->id,
            'category_id' => 'required',
            'tags' => 'array|required'
        ];
    }

    public function attributes()
    {
        return[
            'category_id' => 'category'
        ];
    }
}
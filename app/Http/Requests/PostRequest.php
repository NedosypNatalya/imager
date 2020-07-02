<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:1000'
        ];
    }

    /**
     * @return array
     */
    public function messages(){
        return [
            'title.required' => 'Title required.',
            'content.required' => 'Content required.',
            'title.max' => 'Max 255 symbols.',
            'content.max' => 'Max 1000 symbols.'
        ];
    }
}

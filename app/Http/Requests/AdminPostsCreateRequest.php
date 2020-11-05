<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPostsCreateRequest extends FormRequest
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
            'title' => 'required|min:3|max:100|string',
            'category_id' => 'integer',
            'content' => 'required|min:5|string'
        ];
    }

    public function messages()
    {
        return [
            'title.min' => 'Название должно быть минимум 3 символа',
            'title.required' => 'Поле с наименованием поста не заполнено',
            'title.max' => 'Наименование должно содержать не больее 100 символов',
            'category_id.integer' => 'Категория должна быть integer',
            'content.required' => 'Поле с контентом не заполнено',
            'content.min' => 'Контент должен быть минимум 5 символов',
        ];
    }
}

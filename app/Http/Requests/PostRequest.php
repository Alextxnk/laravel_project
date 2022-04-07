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
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:40', // поле заголовок: обязательное, мин 3 символа, макс 40
            'description' => 'required|min:10|max:600', // поле описание: обязательное, мин 10 символов, макс 600
            'img' => 'mimes:jpg,jpeg,png|max:5000', // допустимые расширения картинок: jpg, jpeg, png; макс размер картинки 5000 Кб
        ];
    }
}

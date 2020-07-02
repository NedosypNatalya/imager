<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
            'address' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages(){
        return [
            'name.required' => 'Поле "Имя" должно быть заполнено.',
            'email.required' => 'Поле "Почта" должно быть заполнено.',
            'password.required' => 'Поле "Пароль" должно быть заполнено.',
            'c_password.required' => 'Поле "Повторение пароля" должно быть заполнено.',
            'address.required' => 'Поле "Адрес" должно быть заполнено.',
            'name.max' => 'Максимальный размер поля "Имя" - 255 символов.',
            'password.min' => 'Размер пароля должен быть больше 5 символов.',
            'email.email' => 'Задан неверный фомат поля "Почта".'
        ];
    }
}

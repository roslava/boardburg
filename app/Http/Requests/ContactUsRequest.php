<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'captcha' => 'required|captcha'
        ];
    }

    public function messages(): array
    {
//        return parent::messages(); // TODO: Change the autogenerated stub
        return [
            'name.required' => 'Поле «Имя» обязательно к заполнению.',
            'email.required' => 'Поле «E-mail» обязательно к заполнению.',
            'subject.required' => 'Поле «Тема сообщения» обязательно к заполнению.',
            'message.required' => 'Введите ваше сообщение.',
            'captcha.required' => 'Введите, пожалуйста, три символа, изображенные на картинке выше.',
            'captcha.validation' => 'Неверно введены символы с картинки.',
        ];
    }
}

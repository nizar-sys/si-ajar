<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestApiRegister extends FormRequest
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
            'username' => 'required|unique:users|min:5',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'password2' => 'required|same:password',
            'role'=>'required',
        ];
    }

    public function messages()
    {
        return [
            '*.unique' => 'This field is already registered',
            '*.required' => 'This field is required',
            '*.min' => 'character must be more than :min',

            'email.email' => 'Invalid format e-mail, ex adding @gmail',
            'password2.same' => 'Confirmation Password not same to Password field'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestApiUserStore extends FormRequest
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
            'role'=>'required',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            '*.unique' => 'This field is already registered',
            '*.required' => 'This field is required',
            '*.min' => 'character must be more than :min',

            'email.email' => 'Invalid format e-mail, ex adding @gmail',
        ];
    }
}

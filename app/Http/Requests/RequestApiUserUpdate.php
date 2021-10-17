<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestApiUserUpdate extends FormRequest
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
            'username' => 'required|min:5',
            'email' => 'required|email',
            'role'=>'required',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'This field is required',
            '*.min' => 'character must be more than :min',

            'email.email' => 'Invalid format e-mail, ex adding @gmail',
        ];
    }
}

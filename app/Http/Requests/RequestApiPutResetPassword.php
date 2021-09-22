<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestApiPutResetPassword extends FormRequest
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
            'email' => 'required|exists:users,email|exists:password_resets,email',
            'token' => 'required|exists:password_resets,token',
            'newpassword' => 'required|min:6',
            'newpassword2' => 'required|same:newpassword',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'This field is required',
            'token.required' => 'Token is required, please check your email!',
            'email.exists' => 'Email not found',
            'token.exists' => 'Invalid token, please check your email!',
            'newpassword.min' => 'New password must be has min 6 characters',
            'newpassword2.same' => 'Confirmation password not same to New password'
        ];
    }   
}

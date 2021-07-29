<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestFilterAbsen extends FormRequest
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
            'jadwal_id'=>'required',
            'tanggal'=>'required',
        ];
    }

    public function messages()
    {
        return [
            '*.required'=>':attribute harus diisi',
        ];
    }
}

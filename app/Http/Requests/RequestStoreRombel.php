<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreRombel extends FormRequest
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
            'rombel'=>'required|unique:tb_kelas',
            'wali_kelas'=>'required',
            'ketua_kelas'=>'nullable|unique:tb_kelas'
        ];
    }

    public function messages()
    {
        return [
            '*.required'=>':attribute harus diisi',
            'ketua_kelas.unique'=>'Kelas yang dipilih sudah ada ketua kelas',
            'rombel.unique'=>'Kelas sudah ada',
        ];
    }
}

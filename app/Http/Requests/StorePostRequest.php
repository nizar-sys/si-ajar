<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'nip' => 'required|min:8|unique:tb_guru',
            'nis' => 'required|min:8|unique:tb_siswa',
            'nama' => 'required',
            'alamat' => 'required|max:200',
            'agama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|email',
            'rombel' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Akun harus dipilih!',
            'nip.required' => 'NIP harus diisi!',
            'nis.required' => 'NIS harus diisi!',
            'nama.required' => 'Nama harus diisi!',
            'alamat.required' => 'Alamat harus diisi!',
            'agama.required' => 'Agama harus diisi!',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih!',
            'tempat_lahir.required' => 'Tempat lahir harus diisi!',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi!',
            'email.required' => 'Email harus diisi!',
            'rombel.required' => 'Rombel harus diisi!',

            'nip.min' => 'NIP harus lebih dari 8 karakter',
            'nip.unique' => 'NIP sudah terdaftar',
            'nis.min' => 'NIS harus lebih dari 8 karakter',
            'nis.unique' => 'NIS sudah terdaftar',
            'user_id.unique' => 'Akun sudah terdaftar',
            'alamat.max' => 'Jumlah karakter melebihi batas',
            'tanggal_lahir.date' => 'Tanggal lahir harus berformat tahun/bulan/tanggal',
            'email.email' => 'Harus email valid, contoh: email@gmail.com !'
        ];
    }
}

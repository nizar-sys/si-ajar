<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\MyTestMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|unique:users|min:5',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'password2' => 'required|same:password'
        ];

        $message = [
            'username.required' => 'username wajib diisi',
            'email.required' => 'email wajib diisi',
            'password.required' => 'password wajib diisi',
            'password2.required' => 'konfirmasi password wajib diisi',

            'username.unique' => 'Username sudah terdaftar',
            'email.unique' => 'Email sudah terdaftar',
            'username.min' => 'Username minimal 5 karakter!',
            'password.min' => 'Password minimal 6 karakter!',
            'password2.same' => 'Konfirmasi password tidak sesuai',
            'email.email' => 'Harus email valid, contoh email@gmail.com !',
        ];

        $validated = $this->validate($request, $rules, $message);

        $createUser = User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'email' => $validated['email'],
            'activation_code' => $validated['username'] . Str::random(20),
        ]);

        if ($createUser) {
            $details = [
                'title' => 'Aktivasi akun Si-Ajar',
                'body' => 'Klik button untuk aktivasi akun',
                'urlActivation' => 'http://si-ajar.herokuapp.com/' . 'activation/' . $createUser['activation_code'],
            ];
            Mail::to($validated['email'])->send(new MyTestMail($details));
            return redirect('/')->with('message', 'Berhasil registrasi, silahkan aktivasi akun anda tlb dulu !');
        } else {
            return redirect('/register/create')->with('message', 'Registrasi gagal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verifikasi($codeVerifikasi)
    {
        $akunByCodeVerif = DB::table('users')->where('activation_code', $codeVerifikasi)->get()->first();
        if ($akunByCodeVerif) {
            $akunByCodeVerif = DB::table('users')->where('activation_code', $codeVerifikasi)->update([
                'active'=>'1',
            ]);
            return redirect('/')->with('message', 'Akun berhasil diverifikasi');
        }else{
            return redirect('/')->with('message', 'Akun gagal diverifikasi');
        }
    }
}

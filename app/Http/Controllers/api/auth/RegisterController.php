<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestApiRegister;
use App\Mail\MyTestMail;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Throwable;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->success(null, 'Sistem Aplikasi Belajar | Register');
        } catch (Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestApiRegister $request)
    {
        try {
            $validated = $request->validated();

            $createUser = User::create([
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
                'email' => $validated['email'],
                'activation_code' => Str::random(80),
            ]);
    
            if(!$createUser){
                return $this->error('Registrasi gagal', 400);
            }
    
            $details = [
                'title' => 'Aktivasi akun Si-Ajar',
                'body' => 'Klik button untuk aktivasi akun',
                'urlActivation' => 'http://127.0.0.1:8000/' . 'activation/' . $createUser['activation_code'],
            ];
            Mail::to($validated['email'])->send(new MyTestMail($details));
    
            return $this->success([
                'token' => $createUser->createToken('API Token')->plainTextToken,
                'userData' => $createUser,
            ], 'Pengguna baru berhasil diregistrasi', 201);
        } catch (Throwable $th) {
            return $this->error('error', 400, $th);
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
        try {
            $user = User::where('activation_code', $codeVerifikasi)->first();

            if(!$user){
                return $this->error('Account / activation code is not found', 200, null);
            }

            $user->update([
                'active' => '1',
                'updated_at' => date(now()),
            ]);

            return $this->success([
                'userData' => $user,
            ], 'Your account has beed activated!');
        } catch (\Throwable $th) {
            return $this->error('Wrong activation code', 200, $th);
        }
    }
}

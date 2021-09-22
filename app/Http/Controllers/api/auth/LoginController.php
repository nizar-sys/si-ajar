<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestApiForgotPassword;
use App\Http\Requests\RequestApiLogin;
use App\Http\Requests\RequestApiPutResetPassword;
use App\Mail\EmailForgotPassword;
use App\Models\PasswordReset;
use App\Models\User;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(null, 'Sistem Aplikasi Belajar | Login');
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
    public function store(RequestApiLogin $request)
    {
        $validated = $request->validated();

        try {
            $user = User::where('username', $validated['username'])->first();

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return $this->error('Your account is not registered / wrong password', 400);
            }

            return $this->success([
                'userData' => $user,
                'token' => $user->createToken('API Token')->plainTextToken
            ], 'Login Successfully');
            
        } catch (\Throwable $th) {
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

    public function resetPassword(RequestApiForgotPassword $request)
    {
        try {
            $validated = $request->validated();

            $token = Str::random(80);

            PasswordReset::create([
                'email' => $validated['email'],
                'token' => $token,
                'created_at' => date(now())
            ]);
            
            $details = [
                'title' => 'Password Resets',
                'token' => $token,
                'body' => 'Klik buttton untuk atur ulang katasandi akun Anda',
            ];
            Mail::to($validated['email'])->send(new EmailForgotPassword($details));

            return $this->success([
                'tokenResetPassword' => $token,
            ], 'We have e-mailed your password reset link!');
        } catch (\Throwable $th) {
            return $this->error('Error', 400, $th);
        }
    }

    public function putResetPassword(RequestApiPutResetPassword $request)
    {
        try {
            $validated = $request->validated();

            $user = User::where('email', $validated['email'])->first();
            $passwordResets = PasswordReset::where('email', $validated['email']);
            $user->update([
                'password' => Hash::make($validated['newpassword']),
                'updated_at' => date(now())
            ]);
            $passwordResets->delete();

            return $this->success([], 'Password changed');


        } catch (\Throwable $th) {
            return $this->error("Error", 400, $th);
        }
    }


    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return $this->success(null, 'Logout Successfully');
    }
}

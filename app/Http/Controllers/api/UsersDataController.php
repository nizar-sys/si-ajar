<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestApiRegister;
use App\Http\Requests\RequestApiUserStore;
use App\Http\Requests\RequestApiUserUpdate;
use App\Mail\MyTestMail;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UsersDataController extends Controller
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
            $users = User::all();
            return $this->success([
                'usersData' => $users,
            ], 'Success');
        } catch (\Throwable $th) {
            return $this->error('Error, Cant read list users', 400, $th);
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
    public function store(RequestApiUserStore $request)
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

            if (!$createUser) {
                return $this->error('New user failed to stored', 400);
            }

            $details = [
                'title' => 'Aktivasi akun Si-Ajar',
                'body' => 'Klik button untuk aktivasi akun',
                'urlActivation' => 'http://127.0.0.1:8000/' . 'activation/' . $createUser['activation_code'],
            ];
            Mail::to($validated['email'])->send(new MyTestMail($details));

            return $this->success([], 'Pengguna baru berhasil ditambah', 201);
        } catch (\Throwable $th) {
            return $this->error('Error, Cant store new users data', 403, $th);
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
        try {

            $user = User::where('id', $id)->first();

            if (!$user) {
                return $this->error('User not found', 403, null);
            }

            return $this->success([
                'userData' => $user
            ], 'User find!');
        } catch (\Throwable $th) {
            return $this->error('Error, Cant read user', 403, $th);
        }
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
    public function update(RequestApiUserUpdate $request, $id)
    {
        try {

            $validated = $request->validated();

            $user = User::find($id);

            if(!$user){
                return $this->error('User not found', 403);
            }

            $user->update([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'updated_at' => date(now())
            ]);

            return $this->success(null, 'Update success');

        } catch (\Throwable $th) {
            return $this->error('Error, Cant update user!', 403, $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $user = User::where('id', $id)->first();

            if(!$user){
                return $this->error('User not found', 403, null);
            }

            $user->tokens()->delete(); // delete token user's

            $user->delete(); // delete user's account

            return $this->success(null, 'User deleted!');

        } catch (\Throwable $th) {
            return $this->error('Error, Cant delete this user', 403, null);
        }
    }
}

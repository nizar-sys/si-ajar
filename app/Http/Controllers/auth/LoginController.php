<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
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
    public function store(Request $request)
    {
        $rules = [
            'username'=>'required',
            'password'=>'required'
        ];

        $message = [
            'username.required'=>'Username harus diisi!',
            'password.required'=>'Password harus diisi!',
        ];

        $validated = $this->validate($request, $rules, $message);

        $data = [
            'username'=>$validated['username'],
            'password'=>$validated['password'],
        ];

        Auth::attempt($data);

        if (Auth::check()) {
            // check role / level
            if(Auth::user()->role === '1'){
                return redirect()->route('admin.index');
            }elseif(Auth::user()->role === '2'){
                return redirect()->route('guru.index');
            }else{
                return redirect('siswa');
            }
        }else{
            return redirect('/login')->with('error', 'Username / Password salah');
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

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

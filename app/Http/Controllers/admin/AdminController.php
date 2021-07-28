<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('isActive');   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    // crud guru

    public function dataGuru()
    {
        $guru = Teacher::all();
        $user = DB::table('users')->where('role', '2')->get();
        // dd($user);
        return view('admin.data-guru.index', compact('guru', 'user'));
    }

    public function tambahGuru(Request $request)
    {
        $rules = [
            'user_id'=>'required|unique:tb_guru',
            'nip' => 'required|min:8|unique:tb_guru',
            'nama' => 'required',
            'alamat' => 'required|max:200',
            'agama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'email'=>'required|email',
        ];

        $message = [
            'user_id.required' => 'Akun guru harus dipilih!',
            'nip.required' => 'NIP harus diisi!',
            'nama.required' => 'Nama harus diisi!',
            'alamat.required' => 'Alamat harus diisi!',
            'agama.required' => 'Agama harus diisi!',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih!',
            'tempat_lahir.required' => 'Tempat lahir harus diisi!',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi!',
            'email.required' => 'Email harus diisi!',
            
            'nip.min' => 'NIP harus lebih dari 8 karakter',
            'nip.unique' => 'NIP sudah terdaftar',
            'user_id.unique' => 'Akun guru sudah terdaftar',
            'alamat.max' => 'Jumlah karakter melebihi batas',
            'tanggal_lahir.date' => 'Tanggal lahir harus berformat tahun/bulan/tanggal',
            'email.email'=>'Harus email valid, contoh: email@gmail.com !'
        ];

        $validated = $this->validate($request, $rules, $message);

        $tambahGuru = Teacher::create([
            'user_id'=>$validated['user_id'],
            'nama' => $validated['nama'],
            'nip' => $validated['nip'],
            'alamat' => $validated['alamat'],
            'agama' => $validated['agama'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'email'=>$validated['email'],
            'created_at' => date(now()),
            'updated_at' => date(now()),
        ]);

        if ($tambahGuru) {
            return redirect('/data-guru')->with('message', 'Data guru berhasil ditambahkan!');
        } else {
            return redirect('/data-guru')->with('error', 'Data guru gagal ditambah');
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
    public function store(Request $request)
    {
        //
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
    public function edit($nip)
    {
        $guruById = DB::table('tb_guru')->where('nip', $nip)->get()->first();
        // dd($guruById);
        return view('admin.data-guru.update', compact('guruById'));
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
        $findDataAndUpdate = Teacher::find($id)->update($request->all());

        if ($findDataAndUpdate) {
            return redirect('/data-guru')->with('message', 'Data guru berhasil diubah');
        } else {
            return redirect('/data-guru')->with('error', 'Data guru gagal diubah');
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
        $findDataAndDelete = Teacher::find($id)->delete();
        if ($findDataAndDelete) {
            return redirect('/data-guru')->with('message', 'Data guru berhasil dihapus');
        } else {
            return redirect('/data-guru')->with('error', 'Data guru gagal dihapus');
        }
    }
}

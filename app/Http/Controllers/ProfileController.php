<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
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
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Auth::user()->role;
        $kelas = Kelas::all(['id', 'rombel']);
        return view('my-profile.konfirmasi-data', compact('role', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = $request->role;

        if ($role === "2") {
            $rules = [
                'id' => 'required|unique:tb_guru',
                'nip' => 'required|min:8|unique:tb_guru',
                'nama' => 'required',
                'alamat' => 'required|max:200',
                'agama' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
            ];
        } else {
            $rules = [
                'id' => 'required|unique:tb_siswa',
                'nis' => 'required|min:8|unique:tb_siswa',
                'nama' => 'required',
                'alamat' => 'required|max:200',
                'agama' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
                'rombel' => 'required',
            ];
        }


        $message = [
            'id.required' => 'Akun harus dipilih!',
            'nip.required' => 'NIP harus diisi!',
            'nis.required' => 'NIS harus diisi!',
            'nama.required' => 'Nama harus diisi!',
            'alamat.required' => 'Alamat harus diisi!',
            'agama.required' => 'Agama harus diisi!',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih!',
            'tempat_lahir.required' => 'Tempat lahir harus diisi!',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi!',
            'rombel.required' => 'Rombel harus diisi!',

            'nip.min' => 'NIP harus lebih dari 8 karakter',
            'nip.unique' => 'NIP sudah terdaftar',
            'nis.min' => 'NIS harus lebih dari 8 karakter',
            'nis.unique' => 'NIS sudah terdaftar',
            'id.unique' => 'Akun sudah terdaftar',
            'alamat.max' => 'Jumlah karakter melebihi batas',
            'tanggal_lahir.date' => 'Tanggal lahir harus berformat tahun/bulan/tanggal',
        ];

        $validated = $this->validate($request, $rules, $message);

        // jika role guru, maka konfirmasi data guru. jika siswa, maka konfirmasi data siswa
        if ($role === '2') {
            $konfirmasiGuru = Teacher::create([
                'user_id' => $validated['id'],
                'nama' => $validated['nama'],
                'nip' => $validated['nip'],
                'alamat' => $validated['alamat'],
                'agama' => $validated['agama'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'created_at' => date(now()),
                'updated_at' => date(now()),
            ]);

            if ($konfirmasiGuru) {
                return redirect('/profile/' . $validated['id'])->with('message', 'Berhasil konfirmasi data!');
            } else {
                return redirect()->route('profile.create')->with('error', 'Data gagal dikonfirmasi');
            }
        } else {
            $konfirmasiSiswa = Student::create([
                'user_id' => $validated['id'],
                'nama' => $validated['nama'],
                'nis' => $validated['nis'],
                'alamat' => $validated['alamat'],
                'agama' => $validated['agama'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'rombel_id' => $validated['rombel'],
                'created_at' => date(now()),
                'updated_at' => date(now()),
            ]);

            if ($konfirmasiSiswa) {
                return redirect('/profile/' . $validated['id'])->with('message', 'Berhasil konfirmasi data');
            } else {
                return redirect()->route('profile.create')->with('error', 'Data gagal dikonfirmasi');
            }
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
        $role = Auth::user()->role;
        $user_id = $id;

        if ($role === '2') {

            // cek data pembelajaran (data siswa & guru)
            $cekData = DB::table('tb_guru')->where('user_id', $user_id)->get()->first();
            if ($cekData != null) {
                return view('my-profile.index', compact('cekData'));
            } else {
                return redirect()->route('profile.create')->with('error', 'Silahkan konfirmasi data Anda dulu!');
            }
        } else {
            // cek data pembelajaran (data siswa & guru)
            $cekData = DB::table('tb_siswa')->where('user_id', $user_id)->get()->first();
            if ($cekData != null) {
                return view('my-profile.index', compact('cekData'));
            } else {
                return redirect()->route('profile.create')->with('error', 'Silahkan konfirmasi data Anda dulu!');
            }
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
    public function update(Request $request)
    {
        $role = $request->role;

        if ($role === "2") {
            $updateData = Teacher::find($request->id);
            $updateData->update([
                'nama'=>$request->nama,
                'nip'=>$request->nip,
                'alamat'=>$request->alamat,
                'agama'=>$request->agama,
                'jenis_kelamin'=>$request->jenis_kelamin,
                'tempat_lahir'=>$request->tempat_lahir,
                'tanggal_lahir'=>$request->tanggal_lahir,
                'email'=>$request->email,
                'updated_at'=>date(now()),
            ]);
        }else{
            $updateData = Student::find($request->id);
            $updateData->update([
                'nama'=>$request->nama,
                'nis'=>$request->nis,
                'alamat'=>$request->alamat,
                'agama'=>$request->agama,
                'jenis_kelamin'=>$request->jenis_kelamin,
                'tempat_lahir'=>$request->tempat_lahir,
                'tanggal_lahir'=>$request->tanggal_lahir,
                'email'=>$request->email,
                'updated_at'=>date(now()),
            ]);
        }

        if($updateData){
            return redirect('/profile/' . $request->user_id)->with('message', 'Data berhasil diubah');
        }else{
            return redirect('/profile/' . $request->user_id)->with('error', 'Data gagal diubah');
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
        //
    }

    public function changeFoto(Request $request)
    {
        $request->validate([
            'foto' => 'image|mimes:jpg,png,jpeg,gif,svg|max:3000',
        ]);

        $imageName = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('/dist/img'), $imageName);

        $role = $request->role;

        // jika role guru, update foto guru . jika role siswa, yang diupdate foto siswa
        if ($role === "2") {
            $changeFoto = DB::table('tb_guru')->where('user_id', $request->user_id)->update([
                'foto' => $imageName
            ]);
        }else{
            $changeFoto = DB::table('tb_siswa')->where('user_id', $request->user_id)->update([
                'foto' => $imageName
            ]);
        }

        if ($changeFoto) {
            return redirect('/profile/' . $request->user_id)->with('message', 'Foto berhasil diubah');
        } else {
            return redirect('/profile/' . $request->user_id)->with('message', 'Foto gagal diubah');
        }
    }
}

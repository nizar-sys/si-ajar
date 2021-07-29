<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreAbsen;
use App\Models\Absensi;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Student::all()
                                ->where('user_id', Auth::user()->id)->first();
        if($siswa != null){
            $absensi = Absensi::all()
                                    ->where('siswa_id', $siswa->id);
            return view('siswa.absenku.index', compact('absensi'));
        }else{
            return redirect()->route('profile.create')->with('error', 'Kamu harus konfirmasi data lebih dulu!');
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
    public function store(RequestStoreAbsen $request)
    {
        $validated = $request->validated();

        
        // dd($validated, $request->siswa_id);
        $carbon = new Carbon;
        $jam = $carbon->format('H:i');

        $cekAbsen = DB::table('tb_absensi')
                                            ->where('jadwal_id', $validated['jadwal_id'])
                                            ->where('siswa_id', $request->siswa_id)
                                            ->get();

        if($cekAbsen->isEmpty()){

            Absensi::create([
                'jadwal_id'=>$validated['jadwal_id'],
                'siswa_id'=>$request->siswa_id,
                'jam_absen'=>$jam,
                'keterangan'=>$validated['keterangan'],
            ]);

            return redirect('/jadwal')->with('message', 'Berhasil absensi');
        }else{
            return redirect('/jadwal')->with('error', 'Kamu sudah absensi');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreAbsen;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
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

        $tambahAbsen = Absensi::create([
            'jadwal_id'=>$validated['jadwal_id'],
            'siswa_id'=>$request->siswa_id,
            'jam_absen'=>$jam,
            'keterangan'=>$validated['keterangan'],
        ]);

        if($tambahAbsen){
            return redirect('/jadwal')->with('message', 'Berhasil absensi');
        }else{
            return redirect('/jadwal')->with('error', 'Gagal absensi');
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

<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\Ajar;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
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
        return view('siswa.index');
    }

    public function jadwal()
    {
        $siswa = Student::all()->where('user_id', Auth::user()->id)->first();

        if ($siswa) {
            $data = Ajar::all()
                                ->where('rombel_id', $siswa->rombel_id)
                                ->where('status', 'jadwal sudah dimulai')->sortByDesc('id');
            $mapel = Ajar::all()
                                ->where('rombel_id', $siswa->rombel_id)
                                ->where('status', 'jadwal sudah dimulai')->sortByDesc('id');
                                
            $hitungJadwal = count($data);
            return view('siswa.jadwal.index', compact('data', 'siswa', 'mapel', 'hitungJadwal'));
        } else {
            return redirect()->route('profile.create')->with('error', 'Kamu harus verifikasi data tlb dulu');
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
}

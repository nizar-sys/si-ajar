<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreJadwal;
use App\Mail\MyTestMail;
use App\Mail\NotifJadwalBelajar;
use App\Models\Ajar;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AjarController extends Controller
{

    public function __construct()
    {
        return $this->middleware('isGuru');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Teacher::all()->where('user_id', Auth::user()->id)->first();
        if ($guru) {
            $user_id = Auth::user()->id;
            $data = Ajar::all()->where('pengajar_id', $user_id)->sortBy('jam_mulai')->sortBy('tanggal');
            $mapel = Mapel::all();
            $rombel = Kelas::all();

            return view('jadwal-ajar.index', compact('data', 'mapel', 'rombel'));
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
        $rombel_id = $request->rombel;

        $rules = [
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'pengajar' => 'required',
            'mapel' => 'required',
            'rombel' => 'required',
        ];

        $message = [
            '*.required' => ':attribute harus diisi!'
        ];
        $validated = $this->validate($request, $rules, $message);

        $cekJadwal = DB::table('tb_ajar', 'ajar')->
                                                    where('tanggal', $validated['tanggal'])->
                                                    where('jam_mulai', $validated['jam_mulai'])->
                                                    where('jam_selesai', $validated['jam_selesai'])->get();

        if ($cekJadwal->isEmpty()) {
            // carbon
            $carbon = new Carbon;
            $jam = $carbon->format('H:i');
            $tanggal = $carbon->format('Y-m-d');

            // atur status
            if (strtotime($jam) > strtotime($validated['jam_mulai'])) {
                $status = 'jadwal sudah dimulai';
            } else if (strtotime($jam) < strtotime($validated['jam_mulai'])) {
                $status = 'jadwal akan dimulai';
            }
            if (strtotime($validated['tanggal']) > strtotime($tanggal)) {
                $status = 'jadwal yang akan datang';
            }

            $buatJadwal = DB::table('tb_ajar')->insert([
                'tanggal' => $validated['tanggal'],
                'jam_mulai' => $validated['jam_mulai'],
                'jam_selesai' => $validated['jam_selesai'],
                'pengajar_id' => $validated['pengajar'],
                'mapel_id' => $validated['mapel'],
                'rombel_id' => $validated['rombel'],
                'status' => $status,
                'created_at' => date(now()),
            ]);

            if ($buatJadwal) {
                return redirect('/jadwal-ajar')->with('message', 'Berhasil membuat jadwal');
            } else {
                return redirect('/jadwal-ajar')->with('error', 'Gagal menambah jadwal');
            }
        } else if($cekJadwal->first()->tanggal === $validated['tanggal'] && $cekJadwal->first()->jam_mulai === $validated['jam_mulai'] && $validated['mapel'] != $cekJadwal->first()->mapel_id && $validated['rombel'] != $cekJadwal->first()->rombel_id || $validated['mapel'] === $cekJadwal->first()->mapel_id && $validated['rombel'] === $cekJadwal->first()->rombel_id)  {
            return redirect('/jadwal-ajar')->with('error', 'Jadwal bentrok');
        }else{
            return redirect('/jadwal-ajar')->with('error', 'Jadwal bentrok');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ajar  $ajar
     * @return \Illuminate\Http\Response
     */
    public function show(Ajar $ajar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajar  $ajar
     * @return \Illuminate\Http\Response
     */
    public function edit(Ajar $ajar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajar  $ajar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ajar $ajar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajar  $ajar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ajar $ajar)
    {
        //
    }
}

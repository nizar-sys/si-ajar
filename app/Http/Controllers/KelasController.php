<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreRombel;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kelas::all()->sortBy('rombel');
        $guru = Teacher::all();
        $siswa = Student::all();
        return view('admin.data-kelas.index', compact('data', 'guru', 'siswa'));
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
    public function store(RequestStoreRombel $request)
    {
        $validated = $request->validated();
        $rombel = $validated['rombel'][0] . ' ' .  $validated['rombel'][1] . ' ' . '-' . ' ' . $validated['rombel'][2];

        $cekRombel = DB::table('tb_kelas')->where('rombel', $rombel)->get()->first();

        $dbRombel = ($cekRombel != null) ? $dbRombel = $cekRombel->rombel : next($validated);

        if ($dbRombel != null && $rombel != $dbRombel) {
            $tambahRombel = Kelas::create([
                'rombel' => $validated['rombel'][0] . ' ' .  $validated['rombel'][1] . ' ' . '-' . ' ' . $validated['rombel'][2],
                'wali_kelas' => $validated['wali_kelas'],
                'ketua_kelas' => ($validated['ketua_kelas'] != null) ? $validated['ketua_kelas'] : null,
            ]);

            if ($tambahRombel) {
                return redirect('/data-kelas')->with('message', 'Berhasil menambah data rombel');
            } else {
                return redirect('/data-kelas')->with('error', 'Gagal menambah data rombel');
            }
        } else {
            return redirect('/data-kelas')->with('error', 'Data kelas sudah ada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas, $id)
    {
        $kelasById = Kelas::find($id);

        $guru = Teacher::all();
        $siswa = Student::all()->where('rombel_id', $id);
        return view('admin.data-kelas.update', compact('kelasById', 'guru', 'siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $findKelasAndUpdate = Kelas::find($id);

        $findKelasAndUpdate->update($request->all());
        if ($findKelasAndUpdate) {
            return redirect('/data-kelas')->with('message', 'Struktur kelas berhasil diperbarui');
        } else {
            return redirect('/data-kelas')->with('error', 'Struktur kelas gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}

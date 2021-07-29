<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestFilterAbsen;
use App\Models\Absensi;
use App\Models\Ajar;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
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
        return view('guru.index');
    }

    public function listGuru()
    {
        return view('guru.data-guru.index');
    }

    public function dataAbsen($absensi = null)
    {
        $data = Ajar::all()->sortByDesc('id');
        return view('guru.data-absen.index', compact('data', 'absensi'));
    }

    public function filterAbsensi(RequestFilterAbsen $request)
    {
        $validated = $request->validated();

        $absensi = Absensi::all()
                                ->where('jadwal_id', $validated['jadwal_id'])
                                ->where('created_at', '>=', $validated['tanggal']);

        // dd($absensi);
        $data = Ajar::all()->sortByDesc('id');
        return view('guru.data-absen.index', compact('absensi', 'data'));
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

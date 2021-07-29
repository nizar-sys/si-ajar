<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapelController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminGuru');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mapel::all()->sortByDesc('id');
        return view('admin.data-mapel.index', compact('data'));
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
            'nama_mapel' => 'required|unique:tb_mapel',
        ];

        $message = [
            'nama_mapel.required' => 'Mapel harus diisi',
            'nama_mapel.unique' => 'Mapel sudah ada',
        ];

        $validated = $this->validate($request, $rules, $message);

        $createMapel = DB::table('tb_mapel')->insert([
            'nama_mapel' => $validated['nama_mapel'],
            'created_at' => date(now()),
            'updated_at' => null,
        ]);

        if ($createMapel) {
            return redirect('/data-mapel')->with('message', 'Data mapel berhasil ditambah');
        } else {
            return redirect('/data-mapel')->with('error', 'Data mapel gagal ditambah');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel, $id)
    {
        $mapel = Mapel::findOrFail($id);
        return view('admin.data-mapel.update', compact('mapel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $findAndUpdate = Mapel::findOrFail($id);
        $findAndUpdate->update([
            'nama_mapel' => $request['nama_mapel'],
            'updated_at' => date(now())
        ]);

        if ($findAndUpdate) {
            return redirect('/data-mapel')->with('message', 'Data mapel berhasil diubah');
        } else {
            return redirect('/data-mapel')->with('error', 'Data mapel gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel, $id)
    {
        $findAndDelete = Mapel::findOrFail($id);
        $findAndDelete->delete();

        if ($findAndDelete) {
            return redirect('/data-mapel')->with('message', 'Mapel berhasil dihapus');
        } else {
            return redirect('/data-mapel')->with('error', 'Mapel gagal dihapus');
        }
    }
}

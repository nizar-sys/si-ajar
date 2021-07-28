<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Student::all()->sortBy('rombel_id');
        return view('admin.data-siswa.index', compact('data'));
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
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student, $id)
    {
        $siswaById = Student::find($id);
        $rombel = Kelas::all();
        return view('admin.data-siswa.update', compact('siswaById', 'rombel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all(), $id);
        $findAndUpdate = Student::find($id)->update($request->all());
        if ($findAndUpdate) {
            return redirect()->route('data-siswa.index')->with('message', 'Data berhasil diubah');
        } else {
            return redirect()->route('data-siswa.index')->with('erro', 'Data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student, $id)
    {
        $findAndDelete = Student::find($id)->delete();
        if ($findAndDelete) {
            return redirect()->route('data-siswa.index')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect()->route('data-siswa.index')->with('erro', 'Data gagal dihapus');
        }
    }
}

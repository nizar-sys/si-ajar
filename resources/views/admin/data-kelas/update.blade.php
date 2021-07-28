@extends('layouts.app')
@section('title', 'Si Ajar | Admin update kelas')
@section('content')
    <section class="content">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Kelas</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('data-kelas.update', ['data_kela'=>$kelasById->id]) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="wali_kelas">Wali kelas</label>
                                        <select class="form-control @error('wali_kelas')
                                                    is-invalid
                                                    @enderror" id="wali_kelas" name="wali_kelas">
                                            <option selected value="{{ $kelasById->walikelas->user_id }}">
                                                {{ $kelasById->walikelas->nama }}</option>

                                            @foreach ($guru as $guru)
                                                <option value="{{ $guru->user_id }}">{{ $guru->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="ketua_kelas">Ketua kelas</label>
                                        <select class="form-control @error('ketua_kelas')
                                                is-invalid
                                                @enderror" id="ketua_kelas" name="ketua_kelas">

                                            @if ($kelasById->ketuakelas != null)
                                            <option value="">---Hapus ketua kelas---</option>
                                                <option selected value="{{ $kelasById->ketuakelas->user_id }}">
                                                    {{ $kelasById->ketuakelas->nama }}</option>
                                            @else
                                            <option selected value="">---Pilih ketua kelas---</option>
                                                @foreach ($siswa as $siswa)
                                                    <option value="{{ $siswa->user_id }}">{{ $siswa->nama }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <a href="/data-kelas" class="btn btn-secondary" data-dismiss="modal">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

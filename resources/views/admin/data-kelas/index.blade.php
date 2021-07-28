@extends('layouts.app')
@section('title', 'Si Ajar | Data rombel')
@section('content')

    <section class="content">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar rombel</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered text-center" id="table">
                                @if (Auth::user()->role === '1')
                                    <p class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_rombel"><i
                                            class="fas fa-plus"></i> Tambah rombel</p>
                                @endif
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Rombel</th>
                                        <th scope="col">Wali kelas</th>
                                        <th scope="col">Ketua kelas</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->rombel }}</td>
                                            <td>{{ $data->walikelas->nama }}</td>
                                            <td>{{ $data->ketuakelas != null ? $data->ketuakelas->nama : 'Belum ada ketua kelas' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('data-kelas.edit', ['data_kela' => $data->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal add -->
        <div class="modal fade" id="add_rombel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Rombel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('data-kelas.store') }}" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="rombel[]">Jurusan</label>
                                        <select class="form-control" id="rombel[]" name="rombel[]">
                                            <option selected value="RPL">RPL</option>
                                            <option value="BDP">BDP</option>
                                            <option value="HTL">HTL</option>
                                            <option value="PRWST">PRWST</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="rombel[]">Tingkat</label>
                                        <select class="form-control" id="rombel[]" name="rombel[]">
                                            <option selected value="X">X</option>
                                            <option value="XI">XI</option>
                                            <option value="XII">XII</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="rombel[]">Grup</label>
                                        <select class="form-control" id="rombel[]" name="rombel[]">
                                            <option selected value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            @error('rombel[]')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="wali_kelas">Wali kelas</label>
                                <select class="form-control @error('wali_kelas')
                                                                                                            is-invalid
                                                        @enderror" id="wali_kelas" name="wali_kelas">
                                    <option selected value="">--Pilih Wali kelas--</option>
                                    @foreach ($guru as $guru)
                                        <option value="{{ $guru->user_id }}">{{ $guru->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('wali_kelas')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="ketua_kelas">Ketua kelas</label>
                                <select class="form-control @error('ketua_kelas')
                                                                                                            is-invalid
                                                        @enderror" id="ketua_kelas" name="ketua_kelas">
                                    <option selected value="">--Pilih Ketua kelas--</option>
                                    @foreach ($siswa as $siswa)
                                        <option value="{{ $siswa->user_id }}">{{ $siswa->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('ketua_kelas')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="simpan-data" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });

        @if (Session::has('message'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.success("{{ session('message') }}");
        @elseif(Session::has('error'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.error("{{ session('error') }}");
        @endif

        function updateGuru(nip) {
            return window.location.replace(`/update-guru/${nip}`)
        }
    </script>
@endsection

@extends('layouts.app')
@section('title', 'Si - Ajar | Data absensi')
@section('content')
    <section class="content">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data absensi</h3>
                        </div>
                        <div class="card-body">

                            <form action="" method="post">
                                <select class="form-control col-md-2 mb-4 @error('jadwal_id')
                                                                is-invalid
                                            @enderror" id="jadwal_id" name="jadwal_id">
                                    <option selected value="">----Jadwal---</option>
                                    @foreach ($jadwal as $jadwal)
                                        <option value="{{$jadwal->id}}">{{$jadwal->mapel->nama_mapel}}</option>
                                    @endforeach
                                </select>
                            </form>

                            <table class="table table-bordered" id="table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Rombel</th>
                                        <th scope="col">Tanggal <small class="text-danger">(mapel)</small></th>
                                        <th scope="col">Siswa yang absen</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
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
    </script>
@endsection

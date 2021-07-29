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

                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    @if ($absensi != null)
                                        <table class="table table-bordered text-center mt-4" id="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Jadwal <small class="text-danger">(mapel)</small>
                                                    </th>
                                                    <th>Siswa</th>
                                                    <th>Jam absen</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($absensi as $absensi)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $absensi->created_at }}</td>
                                                        <td>{{ $absensi->jadwal->mapel->nama_mapel }}</td>
                                                        <td>{{ $absensi->siswa->nama }}</td>
                                                        <td>{{ $absensi->jam_absen }}</td>
                                                        <td>{{ $absensi->keterangan }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('javascript')
    <script>
        $('#table').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                text: "Import to sheet",
                extend: 'excelHtml5',
                autoFilter: true,
                sheetName: 'Data absensi',
                className: 'btn btn-success'
            }]
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

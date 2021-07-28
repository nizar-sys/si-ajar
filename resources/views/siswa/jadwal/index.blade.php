@extends('layouts.app')
@section('title', 'Si Ajar | Jadwal rombel')

@section('content')
    <section class="content">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Jadwal</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered text-center" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Mapel</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Jam mulai</th>
                                        <th scope="col">Jam selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->mapel->nama_mapel }}</td>
                                            <td>{{ $data->tanggal }}</td>
                                            <td>{{ $data->jam_mulai }}</td>
                                            <td>{{ $data->jam_selesai }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($hitungJadwal != 0)
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#absensi"><i
                                        class="fas fa-calendar-alt"></i> Absensi</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal absensi -->
        <div class="modal fade" id="absensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Absensi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('absensi.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="siswa_id" id="siswa_id" value="{{ $siswa->id }}">

                                        <label for="jadwal_id">Mapel</label>
                                        <select class="form-control @error('jadwal_id')
                                                                    is-invalid
                                            @enderror" id="jadwal_id" name="jadwal_id">
                                            <option value="">---Mapel---</option>

                                            @foreach ($mapel as $item)
                                                <option value="{{$item->id}}">{{$item->mapel->nama_mapel}}</option>
                                            @endforeach
                                        </select>

                                        @error('jadwal_id')
                                            <div class="alert alert-danger mt-2" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <select class="form-control @error('keterangan')
                                                                    is-invalid
                                                        @enderror" id="keterangan" name="keterangan">
                                                <option value="" selected>---Keterangan---</option>
                                                <option value="Hadir">Hadir</option>
                                                <option value="Sakit">Sakit</option>
                                                <option value="Izin">Izin</option>
                                            </select>
                                        </div>

                                        @error('keterangan')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-calendar-alt"></i> Submit</button>
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
    @elseif(Session::has('info'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.info("{{ session('info') }}");
    @endif
</script>
@endsection

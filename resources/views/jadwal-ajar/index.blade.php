@extends('layouts.app')
@section('title', 'Si Ajar | Jadwal ajar')
@section('content')
    <section class="section">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Jadwal</h3>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#buat_jadwal"><i
                                    class="fas fa-plus"></i> Buat jadwal</button>
                            <table class="table table-bordered text-center" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Jam mulai</th>
                                        <th scope="col">Jam selesai</th>
                                        <th scope="col">Mapel</th>
                                        <th scope="col">Rombel</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data != [])
                                        @foreach ($data as $jadwalAjar)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $jadwalAjar->tanggal }}</td>
                                                <td>{{ $jadwalAjar->jam_mulai }}</td>
                                                <td>{{ $jadwalAjar->jam_selesai }}</td>
                                                <td>{{ $jadwalAjar->mapel->nama_mapel }}</td>
                                                <td>{{ $jadwalAjar->rombel->rombel }}</td>
                                                <td>{{ $jadwalAjar->status }}</td>
                                                @if ($jadwalAjar->status === 'jadwal sudah dimulai')
                                                    <td>
                                                        <a href="/data-absensi/{{ $jadwalAjar->id }}"
                                                            class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Data
                                                            absensi</a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal add -->
        <div class="modal fade" id="buat_jadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buat jadwal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('jadwal-ajar.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="pengajar" id="pengajar" value="{{ Auth::user()->id }}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control @error('tanggal')
                                                                                                                is-invalid
                                                        @enderror" id="tanggal" name="tanggal"
                                                placeholder="Masukkan tanggal" value="{{ old('tanggal') }}">
                                        </div>

                                        @error('tanggal')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="jam_mulai">Jam mulai <small class="text-danger">Per
                                                mapel</small></label>
                                        <select class="form-control @error('jam_mulai')
                                                    is-invalid
                                            @enderror" id="jam_mulai" name="jam_mulai">
                                            <option selected value="">----Jam mulai---</option>
                                            <option value="08:00">08:00</option>
                                            <option value="09:00">09:00</option>
                                            <option value="10:00">10:00</option>
                                        </select>

                                        @error('jam_mulai')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="jam_selesai">Jam selesai <small class="text-danger">Per
                                                mapel</small></label>
                                        <select class="form-control @error('jam_selesai')
                                                    is-invalid
                                            @enderror" id="jam_selesai" name="jam_selesai">
                                            <option selected value="">----Jam selesai---</option>
                                            <option value="10:00">10:00</option>
                                            <option value="12:00">12:00</option>
                                            <option value="14:00">14:00</option>
                                        </select>

                                        @error('jam_selesai')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="mapel">Mapel</label>
                                        <select class="form-control @error('mapel')
                                                    is-invalid
                                            @enderror" id="mapel" name="mapel">
                                            <option selected value="">---Mapel---</option>
                                            @foreach ($mapel as $mapel)
                                                <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                            @endforeach
                                        </select>

                                        @error('mapel')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="rombel">Rombel</label>
                                        <select class="form-control @error('rombel')
                                                    is-invalid
                                            @enderror" id="rombel" name="rombel">
                                            <option selected value="">---Rombel---</option>

                                            @foreach ($rombel as $rombel)
                                                <option value="{{ $rombel->id }}">{{ $rombel->rombel }}</option>
                                            @endforeach
                                        </select>

                                        @error('rombel')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
    </script>
@endsection

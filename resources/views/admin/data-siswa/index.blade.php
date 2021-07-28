@extends('layouts.app')
@section('title', 'Si Ajar | Data siswa')
@section('content')
    <section class="section">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data siswa</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered text-center" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Agama</th>
                                        <th scope="col">Jenis kelamin</th>
                                        <th scope="col">Tempat, tanggal lahir</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Rombel</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $siswa)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $siswa->nis }}</td>
                                            <td>{{ $siswa->nama }}</td>
                                            <td>{{ $siswa->alamat }}</td>
                                            <td>{{ $siswa->agama }}</td>
                                            <td>{{ $siswa->jenis_kelamin }}</td>
                                            <td>{{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir }}</td>
                                            <td><img src="{{ asset('/dist/img/' . $siswa->foto) }}" alt=""
                                                    class="img-fluid"></td>
                                            <td>{{ $siswa->rombel->rombel }}</td>
                                            <td>
                                                <a href="{{ route('data-siswa.edit', ['data_siswa' => $siswa->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                <p class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); document.getElementById('form-delete').submit()">
                                                    <i class="fas fa-trash"></i></p>

                                                <form
                                                    id="form-delete"
                                                    action="{{ route('data-siswa.destroy', ['data_siswa' => $siswa->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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

@extends('layouts.app')
@section('title', 'Si Ajar | Data mapel')
@section('content')
    <section class="section">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data mapel</h3>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#add_mapel"><i class="fas fa-plus"></i> Tambah mapel</button>
                            <table class="table table-bordered text-center" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Mapel</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $mapel)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$mapel->nama_mapel}}</td>
                                            <td>
                                                <a href="{{ route('data-mapel.edit', ['data_mapel'=>$mapel->id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" onclick="event.preventDefault(); document.getElementById('delete-mapel').submit();" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

                                                <form id="delete-mapel" action="{{ route('data-mapel.destroy', ['data_mapel'=>$mapel->id]) }}" method="post">
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

        <!-- Modal add -->
        <div class="modal fade" id="add_mapel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah mapel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('data-mapel.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_mapel">Mapel</label>
                                <input type="text" class="form-control @error('nama_mapel')
                                    is-invalid
                                    @enderror" id="nama_mapel" name="nama_mapel" placeholder="Masukkan mapel"
                                    value="{{ old('nama_mapel') }}">
                            </div>

                            @error('nama_mapel')
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
    </script>
@endsection

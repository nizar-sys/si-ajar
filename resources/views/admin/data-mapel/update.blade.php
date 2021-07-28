@extends('layouts.app')
@section('title', 'Si Ajar | Update Data mapel')
@section('content')
    <section class="section">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Data mapel</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('data-mapel.update', ['data_mapel'=>$mapel->id]) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama_mapel">Mapel</label>
                                        <input type="text" class="form-control @error('nama_mapel')
                                            is-invalid
                                            @enderror" id="nama_mapel" name="nama_mapel" placeholder="Masukkan mapel"
                                            value="{{ $mapel->nama_mapel }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="/data-mapel" class="btn btn-secondary" data-dismiss="modal">Kembali</a>
                                    <button type="submit" name="simpan-data" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
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
            $('#table').DataTabl();
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

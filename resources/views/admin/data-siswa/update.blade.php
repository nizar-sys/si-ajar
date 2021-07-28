@extends('layouts.app')
@section('title', 'Si Ajar | Update data siswa')
@section('content')
    <section class="content">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update data siswa</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('data-siswa.update', ['data_siswa'=>$siswaById->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                {{-- <input type="text" name="id" id="id" value="{{$siswaById->id}}"> --}}
                                <div class="form-group">
                                    <label for="nis">NIS</label>
                                    <input type="text" class="form-control @error('nis')
                                                                                                        is-invalid
                                                @enderror" id="nis" name="nis" placeholder="Masukkan nis"
                                        value="{{ $siswaById->nis }}">
                                </div>

                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control @error('nama')
                                                                                                        is-invalid
                                                @enderror" id="nama" name="nama" placeholder="Masukkan nama"
                                        value="{{ $siswaById->nama }}">
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control @error('alamat')
                                                                                                        is-invalid
                                                @enderror" id="alamat" name="alamat" placeholder="Masukkan alamat"
                                        value="{{ $siswaById->alamat }}">
                                </div>

                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select class="form-control @error('agama')
                                                                                        is-invalid
                                                @enderror" id="agama" name="agama">
                                        <option selected value="{{$siswaById->agama}}">{{$siswaById->agama}}</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis kelamin</label>
                                    <select class="form-control @error('jenis_kelamin')
                                                                                        is-invalid
                                                @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                        <option selected value="{{$siswaById->jenis_kelamin}}">{{$siswaById->jenis_kelamin}}</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat lahir</label>
                                            <input type="text" class="form-control @error('tempat_lahir')
                                                                                                                is-invalid
                                                        @enderror" id="tempat_lahir" name="tempat_lahir"
                                                placeholder="Masukkan tempat tinggal" value="{{ $siswaById->tempat_lahir }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal lahir</label>
                                            <input type="date" class="form-control @error('tanggal_lahir')
                                                                                                                is-invalid
                                                        @enderror" id="tanggal_lahir" name="tanggal_lahir"
                                                placeholder="Masukkan tempat tinggal" value="{{ $siswaById->tanggal_lahir }}">
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="rombel">Rombel</label>
                                    <select class="form-control @error('rombel')
                                                                                    is-invalid
                                            @enderror" id="rombel" name="rombel">
                                        <option selected value="{{$siswaById->rombel->rombel}}">{{$siswaById->rombel->rombel}}</option>
                                        @foreach ($rombel as $rombel)
                                             <option value="{{$rombel->id}}">{{$rombel->rombel}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button class="btn btn-primary" type="submit">Konfirmasi</button>
                            </form>
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

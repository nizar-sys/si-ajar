@extends('layouts.app')
@section('title', 'Si Ajar | Konfirmasi data')
@section('content')
    <section class="content">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Konfirmasi Data</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.store') }}" method="post">
                                @csrf

                                <input type="hidden" name="role" id="role" value="{{$role}}">
                                <input type="hidden" name="id" id="id" value="{{Auth::user()->id}}">
                                @if ($role === '2')
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control @error('nip')
                                                                                                            is-invalid
                                                    @enderror" id="nip" name="nip" placeholder="Masukkan nip"
                                            value="{{ old('nip') }}">
                                    </div>

                                    @error('nip')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @elseif($role === '3')
                                    <div class="form-group">
                                        <label for="nis">NIS</label>
                                        <input type="text" class="form-control @error('nis')
                                                                                                            is-invalid
                                                    @enderror" id="nis" name="nis" placeholder="Masukkan nis"
                                            value="{{ old('nis') }}">
                                    </div>

                                    @error('nis')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endif

                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control @error('nama')
                                                                                                        is-invalid
                                                @enderror" id="nama" name="nama" placeholder="Masukkan nama"
                                        value="{{ old('nama') }}">
                                </div>

                                @error('nama')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control @error('alamat')
                                                                                                        is-invalid
                                                @enderror" id="alamat" name="alamat" placeholder="Masukkan alamat"
                                        value="{{ old('alamat') }}">
                                </div>

                                @error('alamat')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select class="form-control @error('agama')
                                                                                        is-invalid
                                                @enderror" id="agama" name="agama">
                                        <option selected value="">--Pilih agama--</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>

                                @error('agama')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis kelamin</label>
                                    <select class="form-control @error('jenis_kelamin')
                                                                                        is-invalid
                                                @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                        <option selected value="">--Pilih jenis kelamin--</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>

                                @error('jenis_kelamin')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat lahir</label>
                                            <input type="text" class="form-control @error('tempat_lahir')
                                                                                                                is-invalid
                                                        @enderror" id="tempat_lahir" name="tempat_lahir"
                                                placeholder="Masukkan tempat tinggal" value="{{ old('tempat_lahir') }}">
                                        </div>

                                        @error('tempat_lahir')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal lahir</label>
                                            <input type="date" class="form-control @error('tanggal_lahir')
                                                                                                                is-invalid
                                                        @enderror" id="tanggal_lahir" name="tanggal_lahir"
                                                placeholder="Masukkan tempat tinggal" value="{{ old('tanggal_lahir') }}">
                                        </div>

                                        @error('tanggal_lahir')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                @if ($role === '3')
                                    <div class="form-group">
                                        <label for="rombel">Rombel</label>
                                        <select class="form-control @error('rombel')
                                                                                        is-invalid
                                                @enderror" id="rombel" name="rombel">
                                            <option selected value="">--Pilih rombel--</option>
                                            @foreach ($kelas as $rombel)
                                                 <option value="{{$rombel->id}}">{{$rombel->rombel}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @error('rombel')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endif

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

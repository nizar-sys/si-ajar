@extends('layouts.app')
@section('title', 'Si Ajar | My profile')
@section('content')
    <section class="section">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">My Profile</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('/dist/img/' . $cekData->foto) }}" alt="Avatar" class="img-fluid">

                                    <form action="/changeprofile/{{$cekData->user_id}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="user_id" id="user_id" value="{{$cekData->user_id}}">
                                        <input type="hidden" name="role" id="role" value="{{Auth::user()->role}}">
                                        <div class="input-group mb-1 mt-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Foto profile</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="foto" id="inputGroupFile01">
                                                <label class="custom-file-label" for="inputGroupFile01">Foto profile</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-sm" type="submit">Ubah foto profile</button>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <form action="{{ route('profile.update', ['profile'=>$cekData->user_id]) }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <input type="hidden" name="id" id="id" value="{{$cekData->id}}">
                                            <input type="hidden" name="user_id" id="user_id" value="{{$cekData->user_id}}">
                                            <input type="hidden" name="role" id="role" value="{{Auth::user()->role}}">
                                            <div class="col-md-6">
                                                @if (Auth::user()->role === "2")
                                                    <div class="form-group">
                                                        <label for="nip">NIP</label>
                                                        <input type="text" class="form-control @error('nip')
                                                                                                    is-invalid
                                                        @enderror" id="nip" name="nip" placeholder="Masukkan nip" value="{{$cekData->nip}}">
                                                    </div>
                                                @else
                                                    <div class="form-group">
                                                        <label for="nis">NIS</label>
                                                        <input type="text" class="form-control @error('nis')
                                                                                                    is-invalid
                                                        @enderror" id="nis" name="nis" placeholder="Masukkan nis" value="{{$cekData->nis}}">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control @error('nama')
                                                                                                        is-invalid
                                                    @enderror" id="nama" name="nama" placeholder="Masukkan nama" value="{{$cekData->nama}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <input type="text" class="form-control @error('alamat')
                                                                                                is-invalid
                                                    @enderror" id="alamat" name="alamat"
                                                        placeholder="Masukkan alamat" value="{{$cekData->alamat}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="agama">Agama</label>
                                                    <select class="form-control @error('agama')
                                                                                    is-invalid
                                                        @enderror" id="agama" name="agama">
                                                        <option selected value="{{$cekData->agama}}">{{$cekData->agama}}</option>
                                                        <option value="Islam">Islam</option>
                                                        <option value="Kristen">Kristen</option>
                                                        <option value="Katolik">Katolik</option>
                                                        <option value="Budha">Budha</option>
                                                        <option value="Konghucu">Konghucu</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="jenis_kelamin">Jenis kelamin</label>
                                                    <select class="form-control @error('jenis_kelamin')
                                                                                    is-invalid
                                                        @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                                        <option selected value="{{$cekData->jenis_kelamin}}">{{$cekData->jenis_kelamin}}</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tempat_lahir">Tempat lahir</label>
                                                    <input type="text" class="form-control @error('tempat_lahir')
                                                                                                    is-invalid
                                                        @enderror" id="tempat_lahir" name="tempat_lahir"
                                                        placeholder="Masukkan tempat tinggal" value="{{$cekData->tempat_lahir}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tanggal_lahir">Tanggal lahir</label>
                                                    <input type="date" class="form-control @error('tanggal_lahir')
                                                                                                is-invalid
                                                    @enderror" id="tanggal_lahir" name="tanggal_lahir"
                                                        placeholder="Masukkan tempat tinggal" value="{{$cekData->tanggal_lahir}}">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" name="update" id="update" class="btn btn-primary" value="Ubah data">
                                    </form>
                                </div>
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

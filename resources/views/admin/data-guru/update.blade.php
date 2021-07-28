@extends('layouts.app')
@section('title', 'Si Ajar | Admin update guru')
@section('content')
    <section class="content">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update data {{ $guruById->nama }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.update', ['admin'=>$guruById->id]) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id" id="id" value="{{$guruById->id}}">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nip">NIP</label>
                                            <input type="text" class="form-control @error('nip')
                                                                                        is-invalid
                                            @enderror" id="nip" name="nip" placeholder="Masukkan nip"
                                                value="{{ $guruById->nip }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control @error('nama')
                                                                                                    is-invalid
                                                        @enderror" id="nama" name="nama" placeholder="Masukkan nama"
                                                value="{{ $guruById->nama }}">
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
                                                placeholder="Masukkan alamat" value="{{ $guruById->alamat }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <select class="form-control @error('agama')
                                                                            is-invalid
                                                @enderror" id="agama" name="agama">
                                                <option selected value="{{$guruById->agama}}">{{$guruById->agama}}</option>
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
                                                <option selected value="{{$guruById->jenis_kelamin}}">{{$guruById->jenis_kelamin}}</option>
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
                                                placeholder="Masukkan tempat tinggal" value="{{ $guruById->tempat_lahir }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal lahir</label>
                                            <input type="date" class="form-control @error('tanggal_lahir')
                                                                                        is-invalid
                                            @enderror" id="tanggal_lahir" name="tanggal_lahir"
                                                placeholder="Masukkan tempat tinggal" value="{{ $guruById->tanggal_lahir }}">
                                        </div>
                                    </div>
                                </div>

                                
                                <input type="submit" name="update" id="update" class="btn btn-primary" value="Simpan perubahan"><br>
                                <a href="/data-guru">Kembali</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

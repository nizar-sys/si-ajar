@extends('layouts.app')
@section('title', 'Si Ajar | Data guru')
@section('content')

    <section class="content">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar guru</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered text-center" id="table">
                                @if (Auth::user()->role === '1')
                                    <p class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_teacher"><i
                                            class="fas fa-plus"></i> Tambah guru</p>
                                @endif
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nip</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Agama</th>
                                        <th scope="col">Tempat, tanggal lahir</th>
                                        <th scope="col">Jenis kelamin</th>
                                        <th scope="col">Foto</th>
                                        @if (Auth::user()->role === '1')
                                            <th scope="col">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guru as $guru)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $guru->nip }}</td>
                                            <td>{{ $guru->nama }}</td>
                                            <td>{{ $guru->alamat }}</td>
                                            <td>{{ $guru->agama }}</td>
                                            <td>{{ $guru->tempat_lahir }}, {{ $guru->tanggal_lahir }}</td>
                                            <td>{{ $guru->jenis_kelamin }}</td>
                                            <td><img src="{{ asset('/dist/img/' . $guru->foto) }}" alt="" class="img-fluid"></td>
                                            @if (Auth::user()->role === '1')
                                            <td class="d-flex justify-content-center">
                                                <p class="btn btn-warning btn-sm" id="update_guru"
                                                    onclick="updateGuru({{ $guru->nip }})"><i
                                                        class="fas fa-pencil-alt"></i></p>

                                                <form action="{{ route('admin.destroy', ['admin' => $guru->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <input type="hidden" name="id" id="id" value="{{ $guru->id }}">

                                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                            @endif
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
        <div class="modal fade" id="add_teacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah guru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('simpan-data-guru') }}" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="user_id">Akun guru</label>
                                <select class="form-control @error('user_id')
                                                                    is-invalid
                                    @enderror" id="user_id" name="user_id">
                                    <option selected value="">--Pilih Akun Guru--</option>
                                    @foreach ($user as $user)
                                         <option value="{{$user->id}}">{{$user->username}}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('user_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

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
                                    @enderror" id="alamat" name="alamat"
                                    placeholder="Masukkan alamat" value="{{ old('alamat') }}">
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

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email')
                                                                                    is-invalid
                                    @enderror" id="email" name="email"
                                    placeholder="Email@gmail.com" value="{{ old('email') }}">
                            </div>

                            @error('email')
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

        function updateGuru(nip) {
            return window.location.replace(`/update-guru/${nip}`)
        }
    </script>
@endsection

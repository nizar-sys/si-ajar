@extends('layouts.app')
@section('title', 'Si Ajar | Halaman tidak bisa diakses')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Halaman tidak bisa diakses</h4>
                    </div>
                    <div class="card-body">
                        <h3><a href="{{redirect()->back()}}">Kembali</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
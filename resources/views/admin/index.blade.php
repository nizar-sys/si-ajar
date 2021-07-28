@extends('layouts.app')
@section('title', 'Si Ajar | Admin dashboard')
@section('content')
    <h1>hello {{Auth::user()->username}}</h1>
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
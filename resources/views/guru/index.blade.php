@extends('layouts.app')
@section('title', 'Si Ajar | Guru dashboard')
@section('content')
    <h1>hello {{Auth::user()->username}}</h1>

@endsection
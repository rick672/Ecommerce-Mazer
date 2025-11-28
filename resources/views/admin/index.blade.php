@extends('layouts.admin')

@section('content')
    <h1>Bienvenido {{ Auth::user()->name }}</h1>
@endsection

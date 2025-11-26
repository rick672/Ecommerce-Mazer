@extends('layouts.admin')

@section('content')
    <h1>Bienvenido {{ Auth::user()->name }}</h1>
@endsection

@section('scripts')
    <script src="{{ url('/assets/static/js/pages/dashboard.js')}}"></script>
@endsection

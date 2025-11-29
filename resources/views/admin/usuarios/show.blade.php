@extends('layouts.admin')

@section('content')
    <h1>Usuario {{ $usuario->name }}</h1>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Detalles del Usuario</h4>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="rol" class="form-label">Rol</label>
                                <p><i class="bi-shield-fill-check"></i> {{ $usuario->roles->pluck('name')->implode(', ') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Nombre</label>
                                <p><i class="bi-person-badge-fill"></i> {{ $usuario->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <p><i class="bi-envelope-fill"></i> {{ $usuario->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechaHora" class="form-label">Fecha y Hora de Registro</label>
                                <p><i class="bi-calendar-date"></i> {{ $usuario->created_at }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary btn-block">Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
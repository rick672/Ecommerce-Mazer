@extends('layouts.admin')

@section('content')
    <h1>Nuevo Usuario</h1>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Registrar un nuevo Usuario</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/usuarios/create') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Nombre (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi-person-badge-fill"></i></span>
                                        <input 
                                            type="text" name="name" id="name" 
                                            class="form-control"
                                            placeholder="Nombre del Usuario"
                                            value="{{ old('name') }}"
                                            required
                                        >
                                    </div>
                                    @error('name')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Correo Electrónico (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi-envelope-fill"></i></span>
                                        <input 
                                            type="email" name="email" id="email"
                                            class="form-control"
                                            placeholder="ejemplo@correo.com"
                                            value="{{ old('email') }}"
                                            required
                                        >
                                    </div>
                                    @error('email')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">Contraseña (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi-lock-fill"></i></span>
                                        <input 
                                            type="password" name="password" id="password"
                                            class="form-control"
                                            placeholder="Contraseña"
                                            required
                                        >
                                    </div>
                                    @error('password')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Confirmar Contraseña (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi-lock-fill"></i></span>
                                        <input 
                                            type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control"
                                            placeholder="Repita la contraseña"
                                            required
                                        >
                                    </div>
                                    @error('password_confirmation')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
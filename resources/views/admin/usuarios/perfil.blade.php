@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Perfil de Cuenta</h3>
                    <p class="text-subtitle text-muted">Una página donde los usuarios pueden cambiar la información de su
                        perfil.</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="avatar avatar-2xl">
                                    <img src="{{ asset('storage/' . $ajuste->logo) }}" alt="Avatar">
                                </div>

                                <h3 class="mt-3">{{ $usuario->name }}</h3>
                                <p class="text-small">{{ Auth::user()->roles->pluck('name')->implode(', ') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ url('/admin/usuario/' . $usuario->id . '/update_perfil') }}"
                                        method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="name" class="form-label">Nombre de Usuario</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Your Name" value="{{ $usuario->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="form-label">Correo Electrónico</label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                placeholder="Your Email" value="{{ $usuario->email }}">
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Cambiar Contraseña</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('/admin/usuario/' . $usuario->id . '/update_password') }}"
                                        method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group my-2">
                                            <label for="current_password" class="form-label">Contraseña Actual</label>
                                            <input type="password" name="current_password" id="current_password"
                                                class="form-control" placeholder="Ingrese su contraseña actual"
                                                value="">
                                            @error('current_password')
                                                <div role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="password" class="form-label">Nueva Contraseña</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Ingrese su nueva contraseña" value="">
                                            @error('password')
                                                <div role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                                            <input type="password" name="password_confirmation" id="confirm_password"
                                                class="form-control" placeholder="Ingrese nuevamente su contraseña"
                                                value="">
                                            @error('password_confirmation')
                                                <div role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>
                                        <hr>
                                        <div class="form-group my-2 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

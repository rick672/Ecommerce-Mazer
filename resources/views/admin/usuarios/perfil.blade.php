@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Perfil de Cuenta</h3>
                    <p class="text-subtitle text-muted">Una página donde los usuarios pueden cambiar la información de su perfil.</p>
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
                                    <img src="{{ asset('storage/'.$ajuste->logo) }}" alt="Avatar">
                                </div>

                                <h3 class="mt-3">{{ $usuario->name }}</h3>
                                <p class="text-small">{{ Auth::user()->roles->pluck('name')->implode(', ') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="#" method="get">
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
        </section>
    </div>
@endsection

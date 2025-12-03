@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h1>Bienvenid@, {{ Auth::user()->name }}</h1>
            <p class="text-subtitle text-muted"></p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Rol</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->roles->pluck('name')->implode(', ') }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                {{-- Total de roles --}}
                <div class="col-12 col-sm-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <a href="{{ route('admin.roles.index') }}">
                                        <div class="stats-icon blue mb-2">
                                            <i class=""><i class="bi bi-shield-lock-fill"></i></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Roles registrados</h6>
                                    <h6 class="font-extrabold mb-0">{{ $total_roles }}</h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                {{-- Total de usuarios --}}
                <div class="col-12 col-sm-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <a href="{{ route('admin.usuarios.index') }}">
                                        <div class="stats-icon green mb-2">
                                            <i class=""><i class="bi bi-person-fill-add"></i></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Usuarios registrados</h6>
                                    <h6 class="font-extrabold mb-0">{{ $total_usuarios }}</h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                {{-- Total de categorias --}}
                <div class="col-12 col-sm-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <a href="{{ route('admin.categorias.index') }}">
                                        <div class="stats-icon red mb-2">
                                            <i class=""><i class="bi bi-tags-fill"></i></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Categorias registradas</h6>
                                    <h6 class="font-extrabold mb-0">{{ $total_categorias }}</h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                {{-- Total de productos --}}
                <div class="col-12 col-sm-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <a href="{{ route('admin.productos.index') }}">
                                        <div class="stats-icon purple mb-2">
                                            <i class=""><i class="bi bi-box-seam-fill"></i></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Productos registrados</h6>
                                    <h6 class="font-extrabold mb-0">{{ $total_productos }}</h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="./assets/compiled/jpg/1.jpg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">John Duck</h5>
                            <h6 class="text-muted mb-0">@johnducky</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

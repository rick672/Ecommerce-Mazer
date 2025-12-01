@extends('layouts.admin')

@section('content')
    <h1>Categorias {{ $categoria->nombre }}</h1>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Detalles de la Categoria</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre</label>
                                <p><i class="bi-tag-fill"></i> {{ $categoria->nombre }}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="slug" class="form-label">Slug</label>
                                <p><i class="bi-link-45deg"></i> {{ $categoria->slug }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <p><i class="bi-pencil-square"></i> {{ $categoria->descripcion }}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="fechaHora" class="form-label">Fecha y Hora de Registro</label>
                                <p><i class="bi-calendar-date"></i> {{ $categoria->created_at }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ url('/admin/categorias') }}" class="btn btn-secondary btn-block">Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
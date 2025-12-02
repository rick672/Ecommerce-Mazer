@extends('layouts.admin')

@section('content')
    <h1>Producto {{ $producto->nombre }}
        <div class="float-end">
            <a href="{{ url('/admin/productos') }}" class="btn btn-secondary"><i><i class="bi-arrow-left"></i></i> Volver</a>
        </div>
    </h1>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Datos del Producto</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Categoria --}}
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="categoria_id" class="form-label">Categoria</label>
                                <p><i class="bi-tag-fill"></i> {{ $producto->categoria->nombre }}</p>
                            </div>
                        </div>
                        {{-- Nombre del Producto --}}
                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre del Producto</label>
                                <p><i class="bi-box-seam-fill"></i> {{ $producto->nombre }}</p>
                            </div>
                        </div>
                        {{-- Codigo --}}
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="codigo" class="form-label">Código</label>
                                <p><i class="bi-upc-scan"></i> {{ $producto->codigo }}</p>
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                {{-- Descripción corta --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion_corta" class="form-label">Descripción corta</label>
                                        <p><i class="bi-pencil-square"></i> {{ $producto->descripcion_corta }}</p>
                                    </div>
                                </div> 
                                {{-- Precio de Compra --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="precio_compra" class="form-label">Precio Compra</label>
                                        <p><i class="bi-currency-dollar"></i> {{ $producto->precio_compra }} .Bs</p>
                                    </div>
                                </div>
                                {{-- Precio de Venta --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="precio_venta" class="form-label">Precio Venta</label>
                                        <p><i class="bi-currency-dollar"></i> {{ $producto->precio_venta }} .Bs</p>
                                    </div>
                                </div>
                                {{-- Stock --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="stock" class="form-label">Stock</label>
                                        <p><i class="bi-bag-check-fill"></i> {{ $producto->stock }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- Descripción larga --}}
                                    <div class="form-group">
                                        <label for="descripcion_larga" class="form-label">Descripción larga</label>
                                        <p>{!! $producto->descripcion_larga !!}</p>
                                    </div> 
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Galeria de imágenes --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Imagenes del Producto</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($producto->imagenes as $imagen)
                            <div class="col-lg-3 col-md-4 col-12">
                                <div class="card">
                                    <img src="{{ asset('storage/'. $imagen->imagen) }}" class="card-img-top" alt="Logo del Login">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
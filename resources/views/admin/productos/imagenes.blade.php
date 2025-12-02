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
                    <h4>Imagenes del Producto
                        <div class="float-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi-image"></i> Añadir Imagen
                            </button>
                        </div>
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cargar Imagen</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/admin/producto/'.$producto->id.'/upload_imagen') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="imagen" class="form-label">
                                                        Imagen del Producto (*)
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi-image-fill"></i></span>
                                                        <input 
                                                            type="file" name="imagen" id="imagen" 
                                                            onchange="mostrarImagen(event)"
                                                            class="form-control" 
                                                            @error('imagen')
                                                                is-invalid
                                                            @enderror
                                                            accept="image/*" 
                                                        >
                                                        @error('imagen')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <img src="" id="preview1" style="max-width: 230px; margin-top: 10px"  alt="">
                                                    <script>
                                                        const mostrarImagen = e => {
                                                            document.getElementById('preview1').src = URL.createObjectURL(e.target.files[0]);
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($producto->imagenes as $imagen)
                            <div class="col-lg-3 col-md-4 col-12">
                                <div class="card">
                                    <img src="{{ asset('storage/'. $imagen->imagen) }}" class="card-img-top" alt="imagen del producto">
                                    <form action="{{ url('/admin/producto/imagen/'.$imagen->id.'/destroy_imagen') }}" method="POST"
                                        id="miFormulario{{ $imagen->id }}"
                                        class="d-inline"
                                        >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-block"
                                            onclick="preguntar{{ $imagen->id }}(event)"
                                        > 
                                            <i class="bi-trash-fill"></i> Eliminar
                                        </button>
                                    </form>
                                    <script>
                                        function preguntar{{ $imagen->id }}(event) {
                                            event.preventDefault();

                                            Swal.fire({
                                                title: "¿Está seguro de eliminar?",
                                                text: "No podrá revertir esta acción!",
                                                icon: "question",
                                                showDenyButton: true,
                                                confirmButtonText: "Sí, eliminar",
                                                confirmButtonColor: "#3085d6",
                                                denyButtonText: "No, cancelar",
                                                denyButtonColor: "#d33",
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById("miFormulario{{ $imagen->id }}").submit();
                                                }
                                            });
                                        }
                                    </script>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
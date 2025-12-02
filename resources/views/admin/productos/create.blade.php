@extends('layouts.admin')

@section('content')
    <h1>Productos</h1>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Registrar un nuevo Producto</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/productos/create') }}" method="POST">
                        @csrf
                        <div class="row">
                            {{-- Categoria --}}
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="categoria_id" class="form-label">Categoria (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi-tag-fill"></i></span>
                                        <select 
                                            name="categoria_id" id="categoria_id" 
                                            class="form-select"
                                            required
                                        >
                                            <option value="">-- Selecciona una categoria --</option>
                                            @foreach($categorias as $categoria)
                                                <option value="{{ $categoria->id }}"
                                                    {{ old('categoria_id', $producto->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}
                                                >
                                                    {{ $categoria->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('categoria_id')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Nombre del Producto --}}
                            <div class="col-lg-4 col-12">
                                <div class="form-group">
                                    <label for="nombre" class="form-label">Nombre del Producto (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi-box-seam-fill"></i></span>
                                        <input 
                                            type="text" name="nombre" id="nombre" 
                                            class="form-control"
                                            placeholder="Nombre completo del producto"
                                            value="{{ old('nombre') }}"
                                            required
                                        >
                                    </div>
                                    @error('nombre')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            {{-- Codigo --}}
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="codigo" class="form-label">Código (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi-upc-scan"></i></span>
                                        <input 
                                            type="text" name="codigo" id="codigo" 
                                            class="form-control"
                                            placeholder="Código unico del producto"
                                            value="{{ old('codigo') }}"
                                            required
                                        >
                                    </div>
                                    @error('codigo')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    {{-- Descripción corta --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion_corta" class="form-label">Descripción corta (*)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi-pencil-square"></i></span>
                                                <textarea 
                                                    name="descripcion_corta" id="descripcion_corta" 
                                                    class="form-control"
                                                    placeholder="Descripción corta del producto"
                                                    rows="3"
                                                >{{ old('descripcion_corta') }}</textarea>
                                            </div>
                                            @error('descripcion_corta')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                            <small class="form-text text-muted">
                                                La descripción corta debe ser de 1-255 caracteres.
                                            </small>
                                        </div>
                                    </div> 
                                    {{-- Precio de Compra --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="precio_compra" class="form-label">Precio Compra (*)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi-currency-dollar"></i></span>
                                                <input 
                                                    type="text" name="precio_compra" id="precio_compra" 
                                                    class="form-control"
                                                    value="{{ old('precio_compra') }}"
                                                    placeholder="0.00" step="0.01" min="1"
                                                    required
                                                >
                                            </div>
                                            @error('precio_compra')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Precio de Venta --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="precio_venta" class="form-label">Precio Venta (*)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi-currency-dollar"></i></span>
                                                <input 
                                                    type="text" name="precio_venta" id="precio_venta" 
                                                    class="form-control"
                                                    value="{{ old('precio_venta') }}"
                                                    placeholder="0.00" step="0.01" min="1"
                                                    required
                                                >
                                            </div>
                                            @error('precio_venta')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Stock --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="stock" class="form-label">Stock (*)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi-bag-check-fill"></i></span>
                                                <input 
                                                    type="number" name="stock" id="stock" 
                                                    class="form-control"
                                                    value="{{ old('stock') }}"
                                                    placeholder="0" step="1" min="1"
                                                    required
                                                >
                                            </div>
                                            @error('stock')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- Descripción larga --}}
                                        <div class="form-group">
                                            <label for="descripcion_larga" class="form-label">Descripción larga (*)</label>
                                            <div class="input-group">
                                                <div class="w-100">
                                                    <textarea 
                                                        name="descripcion_larga" id="descripcion_larga" 
                                                        class="form-control ckeditor"
                                                        placeholder="Descripción larga del producto"
                                                        rows="3"
                                                    >{{ old('descripcion_larga') }}</textarea>

                                                </div>
                                            </div>
                                            <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    // Editor para el contenido (más completo)
                                                    ClassicEditor
                                                        .create(document.querySelector('#descripcion_larga'), {
                                                            toolbar: {
                                                                items: [
                                                                    'heading', '|',
                                                                    'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                                                                    'link', 'bulletedList', 'numberedList', '|',
                                                                    'outdent', 'indent', '|',
                                                                    'alignment', '|',
                                                                    'blockQuote', 'insertTable', 'mediaEmbed', '|',
                                                                    'undo', 'redo', '|',
                                                                    'fontBackgroundColor', 'fontColor', 'fontSize', 'fontFamily', '|',
                                                                    'code', 'codeBlock', 'htmlEmbed', '|',
                                                                    'sourceEditing'
                                                                ],
                                                                shouldNotGroupWhenFull: true
                                                            },
                                                            language: 'es',
                                                        })
                                                        .catch(error => {
                                                            console.error(error);
                                                        });
                                                });
                                            </script>
                                            @error('descripcion_larga')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                            <small class="form-text text-muted">
                                                La descripción larga debe ser de 1-1000 caracteres.
                                            </small>
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('/admin/productos') }}" class="btn btn-secondary">Volver</a>
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
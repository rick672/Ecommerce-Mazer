@extends('layouts.admin')

@section('content')
    <h1>Modificar Categoria</h1>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Datos de la Categoria</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/categoria/'. $categoria->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="nombre" class="form-label">Nombre (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi-tag-fill"></i></span>
                                        <input 
                                            type="text" name="nombre" id="nombre" 
                                            class="form-control"
                                            placeholder="Nombre de la Categoria"
                                            value="{{ old('nombre', $categoria->nombre ?? '') }}"
                                            required
                                        >
                                    </div>
                                    @error('nombre')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="slug" class="form-label">Slug (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi-link-45deg"></i></span>
                                        <input 
                                            type="text" name="slug" id="slug" 
                                            class="form-control"
                                            placeholder="slug-de-la-categoria"
                                            value="{{ old('slug', $categoria->slug ?? '') }}"
                                            readonly required
                                        >
                                    </div>
                                    @error('slug')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                    <small class="form-text text-muted">
                                        El slug debe ser único y no puede contener espacios.
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi-pencil-square"></i></span>
                                        <textarea 
                                            name="descripcion" id="descripcion" 
                                            class="form-control"
                                            placeholder="Descripción de la Categoria (Opcional)"
                                            rows="3"
                                        >{{ old('descripcion', $categoria->descripcion ?? '') }}</textarea>
                                    </div>
                                    @error('descripcion')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                        
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('/admin/categorias') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Generar slug automáticamente desde el nombre
        document.getElementById('nombre').addEventListener('input', function() {
            let nombre = this.value;
            let slug = nombre.toLowerCase()
                .replace(/[áàäâ]/g, 'a')
                .replace(/[éèëê]/g, 'e')
                .replace(/[íìïî]/g, 'i')
                .replace(/[óòöô]/g, 'o')
                .replace(/[úùüû]/g, 'u')
                .replace(/[ñ]/g, 'n')
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            document.getElementById('slug').value = slug;
        });
    </script>
@endsection
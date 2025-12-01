@extends('layouts.admin')

@section('content')
    <h1>Categorias del Sistema</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center">
                        Categorias registrados
                        <a href="{{ url('/admin/categorias/create') }}" class="btn btn-primary"><i class="bi-plus"></i> Nueva</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row" style="justify-content: end">
                        <div class="col-lg-4 col-md-6 col-12">
                            <form action="{{ url('/admin/categorias') }}" method="GET" style="margin: 0 1rem 1rem 1rem;">
                                <div class="input-group">
                                    <input type="text" name="buscar" class="form-control" placeholder="Buscar ..." value="{{ $_REQUEST['buscar'] ?? '' }}">
                                    @if (request('buscar'))
                                        <a href="{{ url('/admin/categorias') }}" class="btn btn-light">
                                            <i class="bi-trash-fill"></i>
                                        </a>
                                    @endif
                                    <button type="submit" class="btn btn-primary"><i class="bi-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Slug</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nro = ($categorias->currentPage() - 1 ) * $categorias->perPage() + 1;
                                @endphp
                                @foreach($categorias as $categoria)
                                    <tr>
                                        <td>{{ $nro++ }}</td>
                                        <td>{{ $categoria->nombre }}</td>
                                        <td>{{ $categoria->slug }}</td>
                                        <td>{{ $categoria->descripcion }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ url('/admin/categoria/'.$categoria->id) }}" class="btn btn-info btn-sm"><i class="bi-eye-fill"></i></a>
                                                <a href="{{ url('/admin/categoria/'.$categoria->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="bi-pen-fill"></i></a>
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="preguntar{{ $categoria->id }}(event)"
                                                > 
                                                    <i class="bi-trash-fill"></i>
                                                </button>
                                            </div>
                                            <form action="{{ url('/admin/categoria/'.$categoria->id) }}" method="POST" 
                                                class="d-inline"
                                                id="miFormulario{{ $categoria->id }}"
                                            >
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <script>
                                                function preguntar{{ $categoria->id }}(event) {
                                                    event.preventDefault();

                                                    Swal.fire({
                                                        title: "¿Está seguro de borrar?",
                                                        text: "No podrá revertir esta acción!",
                                                        icon: "question",
                                                        showDenyButton: true,
                                                        confirmButtonText: "Sí, eliminar",
                                                        confirmButtonColor: "#3085d6",
                                                        denyButtonText: "No, cancelar",
                                                        denyButtonColor: "#d33",
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            document.getElementById("miFormulario{{ $categoria->id }}").submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($categorias->hasPages())
                        <div class="d-flex justify-content-between aling-items-center mt-4 px-3">
                            <div class="text-muted">
                                Mostrando {{ $categorias->firstItem() }} a {{ $categorias->lastItem() }} de {{ $categorias->total() }} registros
                            </div>
                            <div>
                                {{ $categorias->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

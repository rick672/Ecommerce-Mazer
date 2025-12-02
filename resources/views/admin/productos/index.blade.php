@extends('layouts.admin')

@section('content')
    <h1>Productos del Sistema</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center">
                        Productos registrados
                        <a href="{{ url('/admin/productos/create') }}" class="btn btn-primary"><i class="bi-plus"></i> Nuevo</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row" style="justify-content: end">
                        <div class="col-lg-4 col-md-6 col-12">
                            <form action="{{ url('/admin/productos') }}" method="GET" style="margin: 0 1rem 1rem 1rem;">
                                <div class="input-group">
                                    <input type="text" name="buscar" class="form-control" placeholder="Buscar ..." value="{{ $_REQUEST['buscar'] ?? '' }}">
                                    @if (request('buscar'))
                                        <a href="{{ url('/admin/productos') }}" class="btn btn-light">
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
                                    <th>Categoria</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Descripción corta</th>
                                    <th>Precio Compra</th>
                                    <th>Precio Venta</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nro = ($productos->currentPage() - 1 ) * $productos->perPage() + 1;
                                @endphp
                                @foreach($productos as $producto)
                                    <tr>
                                        <td>{{ $nro++ }}</td>
                                        <td>{{ $producto->categoria->nombre }}</td>
                                        <td>{{ $producto->codigo }}</td>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>{{ $producto->descripcion_corta }}</td>
                                        <td>{{ $ajuste->divisa. ". " .$producto->precio_compra }}</td>
                                        <td>{{ $ajuste->divisa. ". " .$producto->precio_venta }}</td>
                                        <td>{{ $producto->stock }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ url('/admin/producto/'.$producto->id.'/imagenes') }}" class="btn btn-success btn-sm"><i class="bi-image"></i></a>
                                                <a href="{{ url('/admin/producto/'.$producto->id) }}" class="btn btn-info btn-sm"><i class="bi-eye-fill"></i></a>
                                                <a href="{{ url('/admin/producto/'.$producto->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="bi-pen-fill"></i></a>
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="preguntar{{ $producto->id }}(event)"
                                                > 
                                                    <i class="bi-trash-fill"></i>
                                                </button>
                                            </div>
                                            <form action="{{ url('/admin/producto/'.$producto->id) }}" method="POST" 
                                                class="d-inline"
                                                id="miFormulario{{ $producto->id }}"
                                            >
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <script>
                                                function preguntar{{ $producto->id }}(event) {
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
                                                            document.getElementById("miFormulario{{ $producto->id }}").submit();
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
                    @if ($productos->hasPages())
                        <div class="d-flex justify-content-between aling-items-center mt-4 px-3">
                            <div class="text-muted">
                                Mostrando {{ $productos->firstItem() }} a {{ $productos->lastItem() }} de {{ $productos->total() }} registros
                            </div>
                            <div>
                                {{ $productos->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

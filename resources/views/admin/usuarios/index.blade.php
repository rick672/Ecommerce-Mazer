@extends('layouts.admin')

@section('content')
    <h1>Usuarios del Sistema</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center">
                        Usuarios registrados
                        <a href="{{ url('/admin/usuarios/create') }}" class="btn btn-primary"><i class="bi-plus"></i> Nuevo Usuario</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row" style="justify-content: end">
                        <div class="col-md-4 col-sm-6 col-12">
                            <form action="{{ url('/admin/usuarios') }}" method="GET" style="margin: 0 1rem 1rem 1rem;">
                                <div class="input-group">
                                    <input type="text" name="buscar" class="form-control" placeholder="Buscar ..." value="{{ $_REQUEST['buscar'] ?? '' }}">
                                    @if (isset($_REQUEST['buscar']))
                                    <a href="{{ url('/admin/usuarios') }}" class="btn btn-light">
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
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nro = ($usuarios->currentPage() - 1 ) * $usuarios->perPage() + 1;
                                @endphp
                                @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $nro++ }}</td>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->roles->pluck('name')->implode(', ') }}</td>
                                        <td>
                                            <a href="{{ url('/admin/usuario/'.$usuario->id) }}" class="btn btn-info btn-sm"><i class="bi-eye-fill"></i></a>
                                            <a href="{{ url('/admin/usuario/'.$usuario->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="bi-pen-fill"></i></a>
                                            <form action="{{ url('/admin/usuario/'.$usuario->id) }}" 
                                                class="delete-form" method="POST" 
                                                style="display: inline-block"
                                                id="miFormulario{{ $usuario->id }}"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="preguntar{{ $usuario->id }}(event)"
                                                > 
                                                    <i class="bi-trash-fill"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function preguntar{{ $usuario->id }}(event) {
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
                                                            document.getElementById("miFormulario{{ $usuario->id }}").submit();
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
                    @if ($usuarios->hasPages())
                        <div class="d-flex justify-content-between aling-items-center mt-4 px-3">
                            <div class="text-muted">
                                Mostrando {{ $usuarios->firstItem() }} a {{ $usuarios->lastItem() }} de {{ $usuarios->total() }} registros
                            </div>
                            <div>
                                {{ $usuarios->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

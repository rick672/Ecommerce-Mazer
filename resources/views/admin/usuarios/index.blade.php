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
                                    <td>{{ $usuario->rol->name ?? 'Sin asignar' }}</td>
                                    <td>
                                        <a href="{{ url('/admin/usuario/'.$usuario->id) }}" class="btn btn-info btn-sm"><i class="bi-eye-fill"></i></a>
                                        <a href="{{ url('/admin/usuario/'.$usuario->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="bi-pen-fill"></i></a>
                                        <form action="{{ url('/admin/usuario/'.$usuario->id) }}" class="delete-form" method="POST" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                <i class="bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionar todos los botones de eliminar
        const deleteButtons = document.querySelectorAll('.delete-btn');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const form = this.closest('.delete-form');
                
                Swal.fire({
                    title: "¿Está seguro de borrar?",
                    text: "No podrá revertir esta acción!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "No, cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si confirma, enviar el formulario
                        form.submit();
                    }
                    // Si cancela, no hacer nada
                });
            });
        });
    });
</script>
@endpush

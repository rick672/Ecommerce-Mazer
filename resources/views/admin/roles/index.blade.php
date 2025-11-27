@extends('layouts.admin')

@section('content')
    <h1>Roles del Sistema</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center">
                        Roles registrados
                        <a href="{{ url('/admin/roles/create') }}" class="btn btn-primary"><i class="bi-plus"></i> Nuevo Rol</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nro = ($roles->currentPage() - 1 ) * $roles->perPage() + 1;
                            @endphp
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $nro++ }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a href="" class="btn btn-info btn-sm"><i class="bi-eye-fill"></i></a>
                                        <a href="{{ url('/admin/roles/edit/'. $role->id) }}" class="btn btn-warning btn-sm"><i class="bi-pen-fill"></i></a>
                                        <form action="" method="POST" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($roles->hasPages())
                        <div class="d-flex justify-content-between aling-items-center mt-4 px-3">
                            <div class="text-muted">
                                Mostrando {{ $roles->firstItem() }} a {{ $roles->lastItem() }} de {{ $roles->total() }} registros
                            </div>
                            <div>
                                {{ $roles->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
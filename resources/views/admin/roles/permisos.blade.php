@extends('layouts.admin')

@section('content')
    <h1>Permisos del Rol {{ $rol->name }}</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center">
                        Permisos asignados
                    </h4>
                </div>
                <div class="card-body">
                    @foreach ($permisos as $permiso)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permiso_{{ $permiso->id }}" {{ $rol->hasPermissionTo($permiso) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="permiso_{{ $permiso->id }}">
                                {{ $permiso->name }}
                            </label>
                        </div>
                    @endforeach

                    <div class="table-responsive">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

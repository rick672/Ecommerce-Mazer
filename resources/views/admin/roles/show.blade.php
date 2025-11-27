@extends('layouts.admin')

@section('content')
    <h1>Rol {{ $rol->name }}</h1>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Detalles del Rol</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Rol</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi-file-person-fill"></i></span>
                                    <input 
                                        type="text" name="name" id="name" 
                                        class="form-control" 
                                        @error('name')
                                            is-invalid
                                        @enderror
                                        disabled
                                        value="{{ $rol->name }}"
                                    >
                                </div>
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ url('/admin/roles') }}" class="btn btn-secondary btn-block">Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
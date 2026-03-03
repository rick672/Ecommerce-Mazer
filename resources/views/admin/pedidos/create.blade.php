@extends('layouts.admin')

@section('content')
    <h1>Pedido Nro. {{ $pedido->id }}</h1>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Datos del Pedido</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for=""><i class="bi bi-file-earmark-person"></i> Cliente</label>
                            <p>{{ $pedido->usuario->name ?? 'Cliente sin nombre' }} <br>
                                <small>{{ $pedido->usuario->email ?? 'Cliente sin email' }}</small>
                            </p>
                        </div>
                        <div class="col-md-3">
                            <label for=""><i class="bi bi-cash-coin"></i> Total de la orden</label>
                            <p>{{ $pedido->divisa . ' ' . $pedido->total }}</p>
                        </div>
                        <div class="col-md-3">
                            <label for=""><i class="bi bi-cash-coin"></i> Estado de pago</label>
                            <p>{{ $pedido->estado_pago }}</p>
                        </div>
                        <div class="col-md-3">
                            <label><i class="bi bi-cash-coin"></i> Estado de la orden</label>
                            <p>
                                <span
                                    class="badge fs-5 px-3 py-2 
                                        {{ $pedido->estado_orden == 'Procesando' ? 'bg-secondary' : '' }}
                                        {{ $pedido->estado_orden == 'Enviado' ? 'bg-success' : '' }}"
                                >
                                    {{ $pedido->estado_orden }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><i class="bi bi-pin-map-fill"></i> Dirección de envio</label>
                            <p>{{ $pedido->direccion_envio ?? 'No se ha especificado ninguna dirección.' }}</p>
                        </div>
                    </div>

                    <hr>
                    <h5>Detalles del pedido</h5>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm table-striped">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Imagen</th>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $nro = 1;
                                        $total = 0;
                                    @endphp
                                    @foreach ($pedido->detalles as $detalle)
                                        <tr>
                                            <td>{{ $nro++ }}</td>
                                            <td>
                                                @php
                                                    $imagen_producto = $detalle->producto->imagenes->first();
                                                    $imagen = $imagen_producto->imagen ?? '';
                                                @endphp
                                                <img src="{{ asset('storage/' . $imagen) }}" alt="Product Image"
                                                    width="180px" loading="lazy">
                                            </td>
                                            <td>
                                                <b><a
                                                        href="{{ url('/admin/producto/' . $detalle->producto->id) }}">{{ $detalle->producto->nombre }}</a></b>
                                                <br><small>{!! $detalle->producto->descripcion_corta !!}</small>
                                            </td>
                                            <td>{{ $pedido->divisa . ' ' . $detalle->precio }}</td>
                                            <td class="text-center">{{ $detalle->cantidad }}</td>
                                            <td>{{ $pedido->divisa . ' ' . $detalle->precio * $detalle->cantidad }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" style="text-align: right">Total: </th>
                                        <th class="text-center">{{ $pedido->divisa . ' ' . $pedido->total }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    @if ($pedido->estado_orden == 'Procesando')
                        <hr>
                        <h5>Tomar Pedido</h5>


                        <form action="{{ url('/admin/pedido/' . $pedido->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nota" class="form-label">Nota (*)</label>
                                        <div class="input-group">
                                            <div class="w-100">
                                                <textarea name="nota" id="nota" class="form-control ckeditor"
                                                    placeholder="Descripcion detallada del envio de la orden" rows="3">{{ old('nota') }}</textarea>
                                            </div>
                                        </div>
                                        @error('nota')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ url('/admin/pedidos') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Tomar Pedido</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Editor para el contenido (más completo)
            ClassicEditor
                .create(document.querySelector('#nota'), {
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
@endsection

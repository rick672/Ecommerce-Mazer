@extends('layouts.admin')

@section('content')
    <h1>Pedidos del Sistema</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center">
                        Pedidos registrados
                        <a href="{{ url('/admin/pedidos/create') }}" class="btn btn-primary"><i class="bi-plus"></i> Nuevo</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row" style="justify-content: end">
                        <div class="col-lg-4 col-md-6 col-12">
                            <form action="{{ url('/admin/pedidos') }}" method="GET" style="margin: 0 1rem 1rem 1rem;">
                                <div class="input-group">
                                    <input type="text" name="buscar" class="form-control" placeholder="Buscar ..." value="{{ $_REQUEST['buscar'] ?? '' }}">
                                    @if (request('buscar'))
                                        <a href="{{ url('/admin/pedidos') }}" class="btn btn-light">
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
                                    <th>Cliente</th>
                                    <th>Total</th>
                                    <th>Estado del pedido</th>
                                    <th>Estado de la orden</th>
                                    <th>Dirección de envio</th>
                                    <th>Detalles</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nro = ($pedidos->currentPage() - 1 ) * $pedidos->perPage() + 1;
                                @endphp
                                @foreach($pedidos as $pedido)
                                    <tr>
                                        <td>{{ $nro++ }}</td>
                                        <td>{{ $pedido->usuario->name ?? 'Cliente sin nombre' }}</td>
                                        <td>{{ $pedido->divisa . ' ' . $pedido->total }}</td>
                                        <td>{{ $pedido->estado_pago }}</td>
                                        <td>{{ $pedido->estado_orden }}</td>
                                        <td>{{ $pedido->direccion_envio ?? 'No se ha especificado ninguna dirección.' }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($pedido->detalles as $detalle)
                                                    <li>
                                                        {{ $detalle->producto->nombre ?? 'Producto eliminado' }} - 
                                                        Cantidad: {{ $detalle->cantidad }} - 
                                                        Precio: {{ $detalle->divisa . ' ' . $detalle->precio }}
                                                    </li>
                                                    
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ url('/admin/pedido/'.$pedido->id) }}" class="btn btn-success btn-sm"><i class="bi-truck"></i> Tomar Pedido</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($pedidos->hasPages())
                        <div class="d-flex justify-content-between aling-items-center mt-4 px-3">
                            <div class="text-muted">
                                Mostrando {{ $pedidos->firstItem() }} a {{ $pedidos->lastItem() }} de {{ $pedidos->total() }} registros
                            </div>
                            <div>
                                {{ $pedidos->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

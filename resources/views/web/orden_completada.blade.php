@extends('layouts.web')

@section('content')
    <div class="page-title light-background">
        <div class="container text-center">
            <h1 class="mb-2 mb-lg-0" >Confirmacion de Pedido</h1>
        </div>
    </div>
    <section id="confirmation" class="confirmation section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            {{-- Bloque de Agradecimiento --}}
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 text-center p-5 bg-light-subtle">
                        <i class="bi bi-check-circle display-1 text-success mb-3"></i>
                        <h2 class="card-title text-success mb-3">¡Gracias por su compra!</h2>
                        <p class="lead mb-4">
                            Tu pedido ha sido procesado con éxito y esta confirmado. Recibirás una copia de esta confirmación por correo electrónico.
                        </p>
                        <div class="confirmation-details d-flex justify-content-around fw-bold flex-wrap">
                            <span class="mb-2 mb-md-0">
                                **Orden Nº:** <span class="text-primary">{{ $orden->id }}</span>
                            </span>
                            <span class="mb-2 mb-md-0">
                                **Total Pagado:** <span class="text-primary">{{ $orden->divisa .' '. number_format($orden->total, 2, '.', '') }}</span>
                            </span>
                            <span class="mb-2 mb-md-0">
                                **Fecha:** <span class="text-secondary">{{ \Carbon\Carbon::parse($orden->created_at)->format('d-m-Y H:i:s') }}</span>
                            </span>
                            {{-- <span class="mb-2 mb-md-0">
                                **Estado:** <span class="text-primary">{{ $orden->estado_orden }}</span>
                            </span> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- Columna Izquierda: Detalles del pedido --}}
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="mb-3">Productos Adquiridos</h4>
                    <div class="order-items list-group mb-4">
                        @foreach ($orden->detalles as $detalle)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">{{ $detalle->producto->nombre }}</h6>
                                    <small class="text-muted">
                                        {{ $detalle->cantidad }} x {{ $orden->divisa .' '. number_format($detalle->precio, 2, '.', '') }}
                                    </small>
                                </div>
                                <span class="fw-bold">
                                    {{ $orden->divisa .' '. number_format($detalle->cantidad * $detalle->precio, 2, '.', '') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="card p-3 mb-4 border-info-subtle bg-info-subtle">
                        <h5 class="card-title mb-2"><i class="bi bi-geo-alt me-2"></i> Direccion de Envio</h5>
                        <p class="card-text mb-0">**{{ $orden->usuario->name ?? 'Cliente' }}**</p>
                        <p class="card-text mb-0">{{ $orden->usuario->email ?? 'Correo electronico' }}</p>
                        <p class="card-text mb-0">{{ $orden->direccion_envio ?? 'No se ha especificado ninguna dirección.' }}</p>
                    </div>
                </div>
                {{-- Columna Derecha: Resumen de Pago y Contacto --}}
                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="200">
                    {{-- Resumen de Pago --}}
                    <div class="card shadow-sm p-4 mb-4">
                        <h4 class="mb-3">Resumen de Pago</h4>
                        <ul class="list-unstyled">
                            <li class="d-flex justify-content-between fw-bold pt-2 border-top">
                                <span>Total:</span>
                                <span class="text-success fs-5">{{ $orden->divisa .' '. number_format($orden->total, 2, '.', '') }}</span>
                            </li>
                        </ul>
                        <p class="text-muted mt-3 mb-0">
                            Metodo de Pago: <strong>PayPal</strong>
                        </p>
                        <p class="text-muted mt-3 mb-0">
                            Estado: <strong>{{ $orden->estado_orden }}</strong>
                        </p>
                    </div>
                    {{-- Siguiente paso --}}
                    <div class="card shadow-sm p-4 mb-4">
                        <h5 class="mb-3">¿Que sigue?</h5>
                        <p class="mb-2"><i class="bi bi-envelope me-2 text-success"></i> Revisa tu correo electronico para la factura detallada.</p>
                        <p class="mb-2"><i class="bi bi-truck me-2 text-success"></i> Recibiras una notificación por correo electrónico cuando el pedido sea enviado.</p>
                        <p class="mb-0"><i class="bi bi-check-circle me-2 text-success"></i> ¡Listo! Tu pedido ha sido procesado con éxito.</p>
                    </div>
                </div>    
            </div>
        </div>
    </section>
@endsection
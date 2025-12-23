@extends('layouts.web')

@section('content')
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Carrito de compras</h1>
        </div>
    </div><!-- End Page Title -->

    <!-- Cart Section -->
    <section id="cart" class="cart section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row">
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="cart-items">
                        <div class="cart-header d-none d-lg-block">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <h5>Productos</h5>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <h5>Precio</h5>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <h5>Cantidad</h5>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <h5>SubTotal</h5>
                                </div>
                            </div>
                        </div>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($carritos as $carrito)
                            <!-- Cart Item -->
                            <div class="cart-item">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-12 mt-3 mt-lg-0 mb-lg-0 mb-3">
                                        <div class="product-info d-flex align-items-center">
                                            <div class="product-image">
                                                @php
                                                    $imagen_producto = $carrito->producto->imagenes->first();
                                                    $imagen = $imagen_producto->imagen ?? '';
                                                @endphp
                                                <img src="{{ asset('storage/' . $imagen) }}" alt="Product Image"
                                                    class="img-fluid" loading="lazy">
                                            </div>
                                            <div class="product-details">
                                                <h6 class="product-title">{{ $carrito->producto->nombre }}</h6>
                                                <div class="product-meta">
                                                    {{-- cantidad en stock --}}
                                                    <span class="stock">{{ $carrito->producto->stock }} Disponible</span>
                                                </div>
                                                <form action="{{ url('/carrito/' . $carrito->id) }}" method="POST"
                                                    class="d-inline" id="miFormulario{{ $carrito->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        style="
                                                                background: none;
                                                                border: none;
                                                                padding: 0;
                                                                font-size: 0.8125rem;
                                                                color: 
                                                                color-mix(in srgb, #df1b1b, transparent 30%);
                                                                display: inline-flex;
                                                                align-items: center;
                                                                gap: 0.25rem;
                                                                transition: color 0.3s ease;
                                                        "
                                                        class="" type="submit"
                                                        onclick="preguntar{{ $carrito->id }}(event)">
                                                        <i class="bi bi-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                                <script>
                                                    function preguntar{{ $carrito->id }}(event) {
                                                        event.preventDefault();

                                                        Swal.fire({
                                                            title: "¿Está seguro de eliminar?",
                                                            text: "Se borrara el producto de su carrito",
                                                            icon: "question",
                                                            showDenyButton: true,
                                                            confirmButtonText: "Sí, eliminar",
                                                            confirmButtonColor: "#3085d6",
                                                            denyButtonText: "No, cancelar",
                                                            denyButtonColor: "#d33",
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                document.getElementById("miFormulario{{ $carrito->id }}").submit();
                                                            }
                                                        });
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">
                                        <div class="price-tag">
                                            <span
                                                class="current-price">{{ $ajuste->divisa . '. ' . $carrito->producto->precio_venta }}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">
                                        <form action="{{ url('/carrito/actualizar') }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="carrito_id" value="{{ $carrito->id }}">
                                            <div class="quantity-selector">
                                                <button type="submit" class="quantity-btn decrease">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <input type="number" class="quantity-input"
                                                    value="{{ $carrito->cantidad }}" min="1"
                                                    max="{{ $carrito->producto->stock }}" name="cantidad">
                                                <button type="submit" class="quantity-btn increase">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">
                                        <div class="item-total">
                                            @php
                                                $subtotal = $carrito->producto->precio_venta * $carrito->cantidad;
                                                $total += $subtotal;
                                            @endphp
                                            <span>{{ $ajuste->divisa . '. ' . $subtotal }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <div class="cart-actions">
                            <div class="row">
                                <div class="col-lg-6 mb-3 mb-lg-0">

                                </div>
                                <div class="col-lg-6 text-md-end">
                                    <form action="{{ url('/carrito/limpiar') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-outline-remove">
                                            <i class="bi bi-trash"></i> Vaciar Carrito
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                    <div class="cart-summary">
                        <h4 class="summary-title">Resumen de la Orden</h4>

                        <form action="{{ route('web.paypal.checkout') }}" method="POST">
                            @csrf
                            {{-- Direccion de envio --}}
                            <div>
                                <span class="form-label">Dirección de envio</span>
                                <input type="text" class="form-control" name="direccion_envio" required
                                    placeholder="Ingrese su dirección de envío">
                            </div>
                            {{-- Total --}}
                            <div class="summary-total">
                                <span class="summary-label">Total</span>
                                <span class="summary-value">{{ $ajuste->divisa . '. ' . $total }}</span>
                            </div>

                            <div class="checkout-button">
                                <input type="hidden" name="total" value="{{ $total }}">
                                <button type="submit" class="btn btn-accent w-100">
                                    Proceder a la Compra <i class="bi-paypal"></i>
                                </button>
                            </div>
                        </form>

                        <div class="continue-shopping">
                            <a href="{{ url('/') }}" class="btn btn-link w-100">
                                <i class="bi bi-arrow-left"></i> Continuar Comprando
                            </a>
                        </div>

                        <div class="payment-methods">
                            <p class="payment-title">We Accept</p>
                            <div class="payment-icons">
                                <i class="bi bi-credit-card"></i>
                                <i class="bi bi-paypal"></i>
                                <i class="bi bi-wallet2"></i>
                                <i class="bi bi-bank"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Cart Section -->
@endsection

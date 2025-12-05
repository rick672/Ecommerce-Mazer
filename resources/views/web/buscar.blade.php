@extends('layouts.web')

@section('content')
    <section id="best-sellers" class="best-sellers section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Resultados para <span class="text-primary">{{ $query ?? '' }}</span></h2>
            <p>Encuentra productos que te interesan</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-5">
                @if ($productos->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-warning text-center" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <span>No hay productos que coincidan con tu búsqueda</span>
                        </div>
                    </div>
                @else
                    @foreach ($productos as $producto)
                        <!-- Product -->
                        <div class="col-lg-3 col-md-6">
                            <div class="product-item">
                                <div class="product-image">
                                    @php
                                        $imagen_producto = $producto->imagenes->first();
                                        $imagen = $imagen_producto->imagen ?? '';
                                    @endphp
                                    <img src="{{ asset('storage/' . $imagen) }}" alt="Product Image" class="img-fluid"
                                        loading="lazy">
                                    <div class="product-actions">
                                        <button class="action-btn wishlist-btn">
                                            <i class="bi bi-heart"></i>
                                        </button>
                                        <a href="{{ url('/producto/' . $producto->id) }}" class="btn action-btn quickview-btn">
                                            <i class="bi bi-zoom-in"></i>
                                        </a>
                                    </div>
                                    <button class="cart-btn">Añadir al carrito</button>
                                </div>
                                <div class="product-info">
                                    <div class="product-category">{{ $producto->nombre }} </div>
                                    <h4 class="product-name"><a
                                            href="{{ url('/producto/' . $producto->id) }}">{{ $producto->descripcion_corta }}</a>
                                    </h4>
                                    <div class="product-rating">
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </div>
                                        <span class="rating-count">(38)</span>
                                        <span class="badge bg-success">{{ $producto->stock }} disponibles</span>
                                    </div>
                                    <div class="product-price">
                                        {{-- <span class="old-price">$240.00</span> --}}
                                        <span class="current-price">{{ $ajuste->divisa . '. ' . $producto->precio_venta }}</span>
                                    </div>
                                    <div class="color-swatches">
                                        <span class="swatch active" style="background-color: #1f2937;"></span>
                                        <span class="swatch" style="background-color: #f59e0b;"></span>
                                        <span class="swatch" style="background-color: #8b5cf6;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Product -->
                    @endforeach
                    @if ($productos->hasPages())
                        <div class="d-flex justify-content-between aling-items-center mt-4 px-3">
                            <div class="text-muted">
                                Mostrando {{ $productos->firstItem() }} a {{ $productos->lastItem() }} de
                                {{ $productos->total() }} productos
                            </div>
                            <div>
                                {{ $productos->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </section>
@endsection

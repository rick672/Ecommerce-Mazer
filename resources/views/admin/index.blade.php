@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h1>Bienvenid@, {{ Auth::user()->name }}</h1>
            <p class="text-subtitle text-muted"></p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Rol</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ Auth::user()->roles->pluck('name')->implode(', ') }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                @can('Listado de Roles')
                    {{-- Total de roles --}}
                    <div class="col-12 col-sm-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <a href="{{ route('admin.roles.index') }}">
                                            <div class="stats-icon blue mb-2">
                                                <i class=""><i class="bi bi-shield-lock-fill"></i></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Roles registrados</h6>
                                        <h6 class="font-extrabold mb-0">{{ $total_roles }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('Listado de Usuarios')
                    {{-- Total de usuarios --}}
                    <div class="col-12 col-sm-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <a href="{{ route('admin.usuarios.index') }}">
                                            <div class="stats-icon green mb-2">
                                                <i class=""><i class="bi bi-person-fill-add"></i></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Usuarios registrados</h6>
                                        <h6 class="font-extrabold mb-0">{{ $total_usuarios }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('Listado de Categorias')
                    {{-- Total de categorias --}}
                    <div class="col-12 col-sm-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <a href="{{ route('admin.categorias.index') }}">
                                            <div class="stats-icon red mb-2">
                                                <i class=""><i class="bi bi-tags-fill"></i></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Categorias registradas</h6>
                                        <h6 class="font-extrabold mb-0">{{ $total_categorias }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('Listado de Productos')
                    {{-- Total de productos --}}
                    <div class="col-12 col-sm-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <a href="{{ route('admin.productos.index') }}">
                                            <div class="stats-icon purple mb-2">
                                                <i class=""><i class="bi bi-box-seam-fill"></i></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Productos registrados</h6>
                                        <h6 class="font-extrabold mb-0">{{ $total_productos }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('Listado de Pedidos')
                    {{-- Total de pedidos nuevos --}}
                    <div class="col-12 col-sm-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <a href="{{ route('admin.pedidos.index') }}">
                                            <div class="stats-icon red mb-2">
                                                <i class=""><i class="bi bi-bag-plus-fill"></i></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Pedidos nuevos</h6>
                                        <h6 class="font-extrabold mb-0">{{ $total_pedidos_nuevos }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('Listado de Pedidos')
                    {{-- Total de pedidos enviados --}}
                    <div class="col-12 col-sm-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <a href="{{ route('admin.pedidos.index') }}">
                                            <div class="stats-icon blue mb-2">
                                                <i class=""><i class="bi bi-truck"></i></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Pedidos enviados</h6>
                                        <h6 class="font-extrabold mb-0">{{ $total_pedidos_enviados }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('Listado de Pedidos')
                    {{-- Total de pedidos --}}
                    <div class="col-12 col-sm-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <a href="{{ route('admin.pedidos.index') }}">
                                            <div class="stats-icon purple mb-2">
                                                <i class=""><i class="bi bi-bag-check-fill"></i></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Total de pedidos</h6>
                                        <h6 class="font-extrabold mb-0">{{ $total_pedidos }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
            <div class="row">
                <div class="col col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Clientes registrados por mes</h5>
                        </div>
                        <div class="card-body">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Pedidos por mes</h5>
                        </div>
                        <div class="card-body">
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Porcentaje de pedidos</h5>
                        </div>
                        <div class="card-body">
                            <div id="chart3"></div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Productos con stock bajo</h5>
                        </div>
                        <div class="card-body">
                            <div id="chart4"></div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Productos con stock alto</h5>
                        </div>
                        <div class="card-body">
                            <div id="chart5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="./assets/compiled/jpg/1.jpg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">John Duck</h5>
                            <h6 class="text-muted mb-0">@johnducky</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Clientes registrados por mes
        const usuariosData = @json(array_values($usuarios_data));
        var options = {
            chart: {
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            series: [{
                name: 'sales',
                data: usuariosData
            }],
            xaxis: {
                categories: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
                    "Octubre", "Noviembre", "Diciembre"
                ]
            }
        }
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        // Pedidos por mes
        const ordenesData = @json(array_values($ordenes_data));
        var options2 = {
            chart: {
                type: 'bar',
                zoom: {
                    enabled: false
                }
            },
            series: [{
                name: 'sales',
                data: ordenesData
            }],
            xaxis: {
                categories: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
                    "Octubre", "Noviembre", "Diciembre"
                ]
            }
        }
        var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
        chart2.render();

        // Porcentaje de pedidos nuevos vs enviados
        var options3 = {
            series: [{{ $total_pedidos_nuevos }}, {{ $total_pedidos_enviados }}],
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Pedidos Nuevos', 'Pedidos Enviados'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
        chart3.render();

        // Productos con stock bajo
        var options4 = {
            series: [{{ $porcentajeStockBajo }}],
            chart: {
                height: 213,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '70%',
                    }
                },
            },
            labels: ['Productos'],
        };

        var chart4 = new ApexCharts(document.querySelector("#chart4"), options4);
        chart4.render();

        // Productos con stock alto
        var options5 = {
            series: [{{ $porcentajeStockAlto }}],
            chart: {
                height: 213,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '70%',
                    }
                },
            },
            labels: ['Productos'],
        };

        var chart5 = new ApexCharts(document.querySelector("#chart5"), options5);
        chart5.render();
    </script>
@endsection

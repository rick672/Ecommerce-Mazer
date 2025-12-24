<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pedido N° {{ $orden->id }}</title>
    <style>
        /* Estilos generales para el cuerpo del correo */
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eeeeee;
        }

        .header h1 {
            color: #198754;
            font-size: 28px;
        }

        .section-title {
            color: #333333;
            font-size: 18px;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 2px solid #198754;
            padding-bottom: 5px;
        }

        .product-item {
            padding: 10px 0;
            border-bottom: 1px dashed #cccccc;
            display: flex;
            align-items: center;
        }

        .product-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-right: 15px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .summary-table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        .summary-table td {
            padding: 8px 0;
        }

        .summary-table .total-row {
            font-weight: bold;
            font-size: 1.1em;
            border-top: 2px solid #5cb85c;
        }

        .text-success {
            color: #198754;
        }

        .footer {
            text-align: center;
            padding-top: 20px;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>

<body>

    <div style="background-color: #f4f4f4; padding: 20px 0;">
        <div class="container"
            style="width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; background-color:
     #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

            <div class="header" style="text-align: center; padding-bottom: 20px; border-bottom: 1px solid #eeeeee;">
                <h1 style="color: #198754; font-size: 28px;">¡Gracias por tu compra!</h1>
                <p style="font-size: 16px; color: #555555;">Tu pedido *N° {{ $orden->id }}* ha sido confirmado con
                    éxito.</p>
            </div>

            <div
                style="padding: 15px; border: 1px solid #bce8f1; background-color: #d9edf7; border-radius: 4px; margin-top: 20px;">
                <h3 style="color: #31708f; margin-top: 0; font-size: 16px;">Dirección de Envío</h3>
                <p style="margin: 5px 0; color: #31708f;">**{{ $orden->usuario->email ?? 'Cliente' }}**</p>
                <p style="margin: 5px 0; color: #31708f;">{{ $orden->direccion_envio }}</p>
            </div>

            <h2 class="section-title"
                style="color: #333333; font-size: 18px; margin-top: 20px; margin-bottom: 10px; border-bottom: 2px solid #198754; padding-bottom: 5px;">
                Productos Adquiridos</h2>
            @foreach ($orden->detalles as $detalle)
                <div class="product-item"
                    style="padding: 10px 0; border-bottom: 1px dashed #cccccc; display: flex; align-items: center;">

                    {{-- Bloque de Imagen --}}
                    @if ($detalle->producto)
                        @php
                            $imagen_producto = $detalle->producto->imagenes->first();
                            $imagen = $imagen_producto->imagen ?? '';
                        @endphp
                        
                        <img src="{{ asset('storage/' . $imagen) }}"
                            alt="{{ $detalle->producto->nombre }}"
                            style="width: 50px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 4px; border: 1px solid #ddd;">
                    @else
                        <div
                            style="width: 50px; height: 50px; margin-right: 15px; border: 1px solid #ddd; background-color: #eee; text-align: center; line-height: 50px; color: #999;">
                            [IMG]</div>
                    @endif

                    <div style="flex-grow: 1;">
                        <p style="margin: 0; font-weight: bold; color: #333;">{{ $detalle->producto->nombre }}</p>
                        <p style="margin: 0; font-size: 12px; color: #777;">{{ $detalle->cantidad }} x
                            {{ $orden->divisa . ' ' . number_format($detalle->precio, 2) }}</p>
                    </div>

                    <span style="font-weight: bold; color: #333;">
                        {{ $orden->divisa . ' ' . number_format($detalle->cantidad * $detalle->precio, 2) }}
                    </span>
                </div>
            @endforeach

            <h2 class="section-title"
                style="color: #333333; font-size: 18px; margin-top: 20px; margin-bottom: 10px; border-bottom: 2px solid #198754; padding-bottom: 5px;">
                Resumen del Pago</h2>
            <table class="summary-table" style="width: 100%; margin-top: 15px; border-collapse: collapse;">
                <tbody>
                    <tr class="total-row" style="font-weight: bold; font-size: 1.1em; border-top: 2px solid #5cb85c;">
                        <td style="padding: 8px 0;">Total Final:</td>
                        <td class="text-success" style="padding: 8px 0; text-align: right; color: #198754;">
                            {{ $orden->divisa . ' ' . number_format($orden->total, 2) }}</td>
                    </tr>
                </tbody>
            </table>


            <div class="footer" style="text-align: center; padding-top: 20px; font-size: 12px; color: #777777;">
                <p>Este es un correo automático, por favor no responda a esta dirección.</p>
            </div>

        </div>
    </div>

</body>

</html>
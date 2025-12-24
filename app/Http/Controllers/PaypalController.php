<?php

namespace App\Http\Controllers;

use App\Mail\CompraConfirmada;
use App\Models\Ajuste;
use App\Models\Carrito;
use App\Models\DetalleOrden;
use App\Models\Orden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    protected $provider;

    public function __construct()
    {
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials(config('paypal'));
        $this->provider->getAccessToken();
    }


    public function checkout(Request $request)
    {
        // return response()->json($request->all());
        $request->validate([
            'direccion_envio' => 'required|string|max:255',
            'total' => 'required|numeric|min:0.01',
        ]);

        $direccion_formulario = $request->input('direccion_envio');
        $request->session()->put('direccion_envio', $direccion_formulario);
        $total = $request->total;
        $data = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('paypal.currency'),
                        'value' => number_format($total, 2, '.', ''),
                    ],
                    'description' => 'Compra en Mi E-commerce',
                ],
            ],
            'application_context' => [
                'return_url' => route('web.paypal.success'),
                'cancel_url' => route('web.paypal.cancel'),
            ],
        ];

        // $response = $this->provider->createOrder($data);
        try {
            $response = $this->provider->createOrder($data);

            if(isset($response['id']) && $response['status'] == 'CREATED') {
                // redirect to approve href
                foreach($response['links'] as $link) {
                    if($link['rel'] == 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
                return redirect()->route('web.carrito')->with('message', 'No se pudo redirigir a PayPal, intente nuevamente')->with('icon', 'error');
            } else {
                return redirect()->route('web.carrito')->with('message', 'Error al crear la orden en PayPal, intente nuevamente')->with('icon', 'error');
            }
        } catch (\Exception $e) {
            return redirect()->route('web.carrito')
                            ->with('message', 'Exepción capturada: '. $e->getMessage())
                            ->with('icon', 'error');
        }
    }

    public function success(Request $request)
    {
        // return response()->json(['success' => true]);
        $usuario_id = Auth::user()->id;
        $token = $request->query('token');
        try {
            $response = $this->provider->capturePaymentOrder($token);
            if(isset($response['status']) && $response['status'] == 'COMPLETED') {

                $DatosPago = $response['purchase_units'][0]['payments']['captures'][0];
                $total = $DatosPago['amount']['value'];
                $transaction_id = $DatosPago['id'];
                $estado_pago = $DatosPago['status'];
                $divisa = $DatosPago['amount']['currency_code'];
                $estado_orden = 'Procesando';
                $direccion_envio = $request->session()->get('direccion_envio', 'No proporcionada');
                
                DB::beginTransaction();
                try {
                    // Guardar la orden en la base de datos
                    $orden = new Orden();
                    $orden->usuario_id = $usuario_id;
                    $orden->total = $total;
                    $orden->divisa = $divisa;
                    $orden->estado_pago = $estado_pago;
                    $orden->estado_orden = $estado_orden;
                    $orden->transaccion_id = $transaction_id;
                    $orden->direccion_envio = $direccion_envio;
                    $orden->save();

                    // Guardar los detalles de la orden (productos comprados)
                    $carritos = Carrito::where('usuario_id', $usuario_id)->get();
                    foreach ($carritos as $carrito) {
                        $detalle = new DetalleOrden();
                        $detalle->orden_id = $orden->id;
                        $detalle->producto_id = $carrito->producto_id;
                        $detalle->cantidad = $carrito->cantidad;
                        $detalle->precio = $carrito->producto->precio_venta;
                        $detalle->save();

                        // Descontar el stock del producto
                        $producto = $carrito->producto;
                        $producto->stock -= $carrito->cantidad;
                        $producto->save();

                        // Eliminar el producto del carrito
                        $carrito->delete();
                    }

                    DB::commit();
                    
                    Mail::to($orden->usuario->email)->send(new CompraConfirmada($orden));

                    return redirect()->route('web.paypal.orden_completada', $orden->id)->with('message', 'Pago realizado con éxito, ¡gracias por su compra!')->with('icon', 'success');

                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect()->route('web.carrito')
                                    ->with('message', 'Error al registrar el pago en la base de datos: '. $e->getMessage())
                                    ->with('icon', 'error');
                }

                // return redirect()->route('web.carrito')->with('message', 'Pago realizado con éxito, ¡gracias por su compra!')->with('icon', 'success');
            } else {
                return redirect()->route('web.carrito')->with('message', 'El pago no se completó correctamente, intente nuevamente')->with('icon', 'error');
            }
        } catch (\Exception $e) {
            return redirect()->route('web.carrito')
                            ->with('message', 'Exepción capturada: '. $e->getMessage())
                            ->with('icon', 'error');
        }
    }

    public function orden_completada($id)
    {
        // return response()->json(['orden_completada' => true]);
        $orden = Orden::findOrFail($id);
        $ajuste = Ajuste::first();
        return view('web.orden_completada', compact('orden', 'ajuste'));
    }

    public function cancel()
    {
        return response()->json(['cancel' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $token = $request->query('token');
        try {
            $response = $this->provider->capturePaymentOrder($token);
            if(isset($response['status']) && $response['status'] == 'COMPLETED') {
                // redirect to approve href
                // foreach($response['links'] as $link) {
                //     if($link['rel'] == 'approve') {
                //         return redirect()->away($link['href']);
                //     }
                // }
                return redirect()->route('web.carrito')->with('message', 'Pago realizado con éxito, ¡gracias por su compra!')->with('icon', 'success');
            } else {
                return redirect()->route('web.carrito')->with('message', 'El pago no se completó correctamente, intente nuevamente')->with('icon', 'error');
            }
        } catch (\Exception $e) {
            return redirect()->route('web.carrito')
                            ->with('message', 'Exepción capturada: '. $e->getMessage())
                            ->with('icon', 'error');
        }
    }

    public function cancel()
    {
        return response()->json(['cancel' => true]);
    }
}

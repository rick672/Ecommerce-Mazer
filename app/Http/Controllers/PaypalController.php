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

        $response = $this->provider->createOrder($data);
        dd($response);
        // $paypal = $this->provider->checkout($data);

        // return response()->json($paypal);
    }

    public function success()
    {
        return response()->json(['success' => true]);
    }

    public function cancel()
    {
        return response()->json(['cancel' => true]);
    }
}

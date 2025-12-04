<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // return view('web.dashboard');
        if(Auth::check()){
            return view('web.dashboard');
        }else{
            return redirect('/web/login');
        }
    }

    public function carrito()
    {
        return view('web.carrito');
    }

    public function login()
    {
        $ajuste = Ajuste::first();
        return view('web.login', compact('ajuste'));
    }

    public function authenticacion(Request $request)
    {
        // return response()->json($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }else{
            return redirect('/web/login')->withErrors(['login_error' => 'Credenciales incorrectas']);
        }
    }
}

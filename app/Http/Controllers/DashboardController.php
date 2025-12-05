<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function registro()
    {
        $ajuste = Ajuste::first();
        return view('web.registro', compact('ajuste'));
    }

    public function crear_cuenta(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->assignRole('Cliente');
        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
}

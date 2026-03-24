<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use App\Models\Orden;
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
            $ajuste = Ajuste::first();
            $total_pedidos = Orden::where('usuario_id', Auth::user()->id)->count();
            $pedidos = Orden::with('usuario', 'detalles')->where('usuario_id', Auth::user()->id)->get();
            return view('web.dashboard', compact('ajuste', 'total_pedidos', 'pedidos'));
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

    public function ajustes()
    {
        $ajuste = Ajuste::first();
        return view('web.ajustes', compact('ajuste'));
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

    public function informacion_personal(Request $request)
    {
        // return response()->json($request->all());
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('message', 'Informacion actualizada correctamente')
                                    ->with('icon', 'success');
    }

    public function actualizar_password(Request $request)
    {
        // return response()->json($request->all());
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        // Verificar que la contraseña actual sea correcta
        if(!password_verify($request->current_password, $user->password)){
            return redirect()->back()->withErrors(['current_password' => 'La contraseña actual es incorrecta']);
        }
        // Actualizar la contraseña
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('message', 'Contraseña actualizada correctamente')
                                    ->with('icon', 'success');
    }
}

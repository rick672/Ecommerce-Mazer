<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $total_roles = Role::count();
        $total_usuarios = User::whereDoesntHave('roles', function ($query){
            $query->where('name', 'Super Admin');
        } )->count();
        return view('admin.index', compact('total_roles', 'total_usuarios'));
    }
}

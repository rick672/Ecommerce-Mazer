<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Vendedor']);
        Role::create(['name' => 'Cliente']);

        Permission::create(['name' => 'Dashboard del Administrador']);
        Permission::create(['name' => 'Ajustes del Sistema']);
        Permission::create(['name' => 'Actualizar Ajustes del Sistema']);

        Permission::create(['name' => 'Listado de Roles']);
    }
}

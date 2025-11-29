<?php

namespace Database\Seeders;

use App\Models\Ajuste;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Vendedor']);
        Role::create(['name' => 'Cliente']);

        User::create([
            'name' => 'Ricardo Sanchez',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
        ])->assignRole('Super Admin');

        Ajuste::create([
            'nombre' => 'NexusMarket Pro',
            'descripcion' => 'Plataforma de ecommerce integral para negocios digitales',
            'sucursal' => 'Sede Central',
            'direccion' => 'Av. Digital 123, Distrito Tecnológico',
            'telefono' => '+1 234 567 8900',
            'logo' => 'logos/tt5sp0Yc9pbwM6GPBZ5uJXOf7tc4jydQW4xzPAa3.png',
            'imagen_login' => 'imagenes_login/6KBkt9mJEEnBjgx3ZW25j57N5CEpQbpLIZ4GWnXu.png',
            'email' => 'aliagaricardo316@gmail.com',
            'divisa' => 'Bs',
            'pagina_web' => 'https://www.nexusmarketpro.com',
        ]);

    }
}

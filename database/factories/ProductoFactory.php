<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $precioCompra = $this->faker->randomFloat(2, 10, 500);
        $margenGanancia = $this->faker->randomElement([0.10, 0.15, 0.20, 0.25, 0.30, 0.35]);
        $precioVenta = $precioCompra * (1 + $margenGanancia);

        $codigo = 'PROD-'. $this->faker->unique()->numberBetween(1000, 9999);

        $nombresElectronica = [
            'Smartphone 5G', 'Smart TV 55"', 'Smart TV 43"',
            'Laptop Gamer', 'Laptop Ultrabook', 'Tablet Android', 'iPad Mini',
            'Monitor LED 24"', 'Monitor Curvo 32"', 'Monitor 144Hz',
            'Mouse Inalámbrico', 'Mouse Gamer RGB',
            'Teclado Mecánico RGB', 'Teclado Inalámbrico',
            'Auriculares Bluetooth', 'Audífonos In-Ear',
            'Bocina Bluetooth', 'Barra de Sonido',
            'Cámara Reflex', 'Cámara Deportiva', 'Dron Profesional',
            'Impresora Multifuncional', 'Router WiFi 6',
            'Memoria USB 64GB', 'SSD Externo 1TB', 'Disco Duro 1TB',
            'Cargador Rápido', 'Power Bank 10000mAh',
        ];


        $nombresRopa = [
            'Camiseta Oversize', 'Camiseta Básica',
            'Pantalón Jean Slim', 'Pantalón Cargo',
            'Sudadera con Capucha', 'Buzo Deportivo',
            'Chaqueta de Cuero', 'Chamarra de Invierno',
            'Vestido Casual', 'Falda Plisada',
            'Zapatillas Running', 'Zapatillas Urbanas',
            'Sandalias Verano', 'Botas de Cuero',
            'Gorro de Lana', 'Guantes Térmicos',
            'Polo de Algodón', 'Camisa Formal',
            'Short Deportivo', 'Leggings Deportivos',
        ];


        $nombresHogar = [
            'Aspiradora Eléctrica', 'Robot Aspiradora',
            'Licuadora Profesional', 'Batidora de Mano',
            'Microondas 20L', 'Horno Eléctrico',
            'Ventilador de Pie', 'Calefactor Eléctrico',
            'Cafetera Espresso', 'Hervidor Eléctrico',
            'Plancha a Vapor', 'Purificador de Aire',
            'Set de Sartenes', 'Cuchillos de Cocina',
            'Almohada Memory Foam', 'Colchón Ortopédico',
            'Juego de Toallas', 'Cortinas Blackout',
            'Mesa Plegable', 'Silla Ergonómica',
            'Lampara de Escritorio', 'Jarrón Decorativo',
            'Maceta de Cerámica', 'Set de Jardinería',
        ];


        $nombresDeportes = [
            'Balón de Fútbol', 'Balón de Básquet', 'Balón de Vóley',
            'Guantes de Boxeo', 'Guantes de Ciclismo',
            'Bicicleta MTB', 'Bicicleta de Ruta',
            'Cuerda para Saltar', 'Colchoneta de Yoga',
            'Pesas Mancuernas', 'Kettlebell 10kg',
            'Reloj Deportivo', 'Mochila para Gimnasio',
            'Gorra Deportiva', 'Rodillera Deportiva',
            'Raqueta de Tenis', 'Raqueta de Badminton',
            'Casco para Ciclista', 'Zapatillas de Fútbol',
        ];

        $nombresJuguetes = [
            'Muñeca Articulada', 'Set de Bloques',
            'Carrito de Policía', 'Auto de Carrera RC',
            'Dinosaurio Electrónico', 'Peluche Gigante',
            'Juego de Cocina', 'Puzzle 1000 Piezas',
            'Set de Pintura Infantil', 'Robot Interactivo',
            'Avión RC', 'Tren Eléctrico',
            'Pelota Saltarina', 'Juguete Didáctico',
            'Legos Creativos', 'Figuras de Acción',
        ];

        $nombresLibros = [
            'Novela de Misterio', 'Cuentos Infantiles',
            'Manual de Programación', 'Libro de Ciencia',
            'Historia Universal', 'Guía de Negocios',
            'Libro de Cocina', 'Fantasía Épica',
            'Biografía Famosa', 'Libro de Autoayuda',
            'Diccionario Escolar', 'Enciclopedia Juvenil',
        ];

        $nombresAlimentos = [
            'Café Molido 500g', 'Té Verde Premium',
            'Chocolate Amargo', 'Barra de Granola',
            'Arroz 5kg', 'Azúcar 1kg',
            'Aceite Vegetal 900ml', 'Leche Entera',
            'Galletas Integrales', 'Pasta Spaghetti',
            'Refresco 2L', 'Agua Mineral',
            'Salsa de Tomate', 'Atún en Lata',
            'Cereal de Maíz', 'Miel Orgánica',
        ];

        $nombresAutos = [
            'Filtro de Aceite', 'Filtro de Aire',
            'Llanta 14"', 'Llanta 16"',
            'Cera para Autos', 'Shampoo Automotriz',
            'Batería 12V', 'Cámara de Retroceso',
            'GPS Automotriz', 'Cargador USB para Auto',
            'Bombillas LED H7', 'Tapetes de Goma',
            'Aceite de Motor 20W50', 'Compresor de Aire Portátil',
        ];

        $nombresSalud = [
            'Vitamina C 1000mg', 'Protein Whey',
            'Suplemento Omega 3', 'Multivitamínico',
            'Termómetro Digital', 'Oxímetro de Pulso',
            'Tensiómetro', 'Masajeador Eléctrico',
            'Crema Antiinflamatoria', 'Alcohol en Gel',
            'Toallas Húmedas', 'Mascarilla KN95',
            'Bastón de Apoyo', 'Rodillera Ortopédica',
        ];


        $todosNombres = array_merge(
            $nombresElectronica,
            $nombresRopa,
            $nombresHogar,
            $nombresDeportes,
            $nombresJuguetes,
            $nombresLibros,
            $nombresAlimentos,
            $nombresAutos,
            $nombresSalud,
        );


        $nombreBase = $this->faker->randomElement($todosNombres);
        $suffix = $this->faker->randomElement(['Pro', 'Max', 'Plus', 'Ultra', 'Lite', 'Edition', '2024', 'Advance']);
        $nombre = "$nombreBase $suffix";


        return [
            'categoria_id' => Categoria::inRandomOrder()->first()->id ?? Categoria::factory()->create()->id,
            'nombre' => $nombre,
            'codigo' => $codigo,
            'descripcion_corta' => $this->faker->sentence(8),
            'descripcion_larga' => $this->faker->paragraph(3, true),
            'precio_compra' => $precioCompra,
            'precio_venta' => round($precioVenta, 2),
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }

}

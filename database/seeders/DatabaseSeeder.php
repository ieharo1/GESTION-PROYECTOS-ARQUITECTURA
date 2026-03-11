<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Proyecto;
use App\Models\Plano;
use App\Models\Presupuesto;
use App\Models\Material;
use App\Models\Etapa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Arquitecto',
            'email' => 'admin@arquitectura.com',
        ]);

        $cliente1 = Cliente::create([
            'nombre' => 'Carlos Mendoza',
            'cedula' => '1712345678',
            'telefono' => '0991234567',
            'email' => 'carlos.mendoza@email.com',
            'direccion' => 'Av. Principal 123, Quito',
        ]);

        $cliente2 = Cliente::create([
            'nombre' => 'Ana López',
            'cedula' => '1723456789',
            'telefono' => '0982345678',
            'email' => 'ana.lopez@email.com',
            'direccion' => 'Calle Secundaria 456, Guayaquil',
        ]);

        $cliente3 = Cliente::create([
            'nombre' => 'Roberto Sánchez',
            'cedula' => '1734567890',
            'telefono' => '0973456789',
            'email' => 'roberto.sanchez@email.com',
            'direccion' => 'Av. Norte 789, Cuenca',
        ]);

        $proyecto1 = Proyecto::create([
            'cliente_id' => $cliente1->id,
            'nombre' => 'Casa Residencial - Norte',
            'descripcion' => 'Construcción de casa residencial de 2 pisos',
            'presupuesto' => 150000.00,
            'fecha_inicio' => '2025-01-15',
            'fecha_fin' => '2025-12-31',
            'estado' => 'en_progreso',
            'ubicacion' => 'Quito - Sector Norte',
        ]);

        $proyecto2 = Proyecto::create([
            'cliente_id' => $cliente2->id,
            'nombre' => 'Edificio Comercial - Centro',
            'descripcion' => 'Edificio comercial de 4 pisos',
            'presupuesto' => 500000.00,
            'fecha_inicio' => '2025-03-01',
            'fecha_fin' => '2026-06-30',
            'estado' => 'en_progreso',
            'ubicacion' => 'Guayaquil - Centro',
        ]);

        $proyecto3 = Proyecto::create([
            'cliente_id' => $cliente3->id,
            'nombre' => 'Villa de Vacaciones',
            'descripcion' => 'Casa de campo con piscina',
            'presupuesto' => 200000.00,
            'fecha_inicio' => '2025-02-01',
            'fecha_fin' => '2025-10-31',
            'estado' => 'pendiente',
            'ubicacion' => 'Cuenca - Valle',
        ]);

        Plano::create([
            'proyecto_id' => $proyecto1->id,
            'nombre' => 'Planta Baja',
            'tipo' => 'arquitectura',
            'descripcion' => 'Plano de planta baja',
        ]);

        Plano::create([
            'proyecto_id' => $proyecto1->id,
            'nombre' => 'Primer Piso',
            'tipo' => 'arquitectura',
            'descripcion' => 'Plano de primer piso',
        ]);

        Plano::create([
            'proyecto_id' => $proyecto2->id,
            'nombre' => 'Planta Arquitectónica',
            'tipo' => 'arquitectura',
            'descripcion' => 'Plano general del edificio',
        ]);

        Presupuesto::create([
            'proyecto_id' => $proyecto1->id,
            'descripcion' => 'Presupuesto inicial',
            'monto' => 150000.00,
            'estado' => 'aprobado',
        ]);

        Presupuesto::create([
            'proyecto_id' => $proyecto2->id,
            'descripcion' => 'Presupuesto inicial',
            'monto' => 500000.00,
            'estado' => 'en_revision',
        ]);

        Material::create([
            'nombre' => 'Cemento',
            'descripcion' => 'Cemento portland tipo I',
            'cantidad' => 500,
            'unidad' => 'sacos',
            'precio_unitario' => 8.50,
        ]);

        Material::create([
            'nombre' => 'Hierro de construcción',
            'descripcion' => 'Varilla de hierro 12mm',
            'cantidad' => 200,
            'unidad' => 'varillas',
            'precio_unitario' => 12.00,
        ]);

        Material::create([
            'nombre' => 'Ladrillo',
            'descripcion' => 'Ladrillo king kong',
            'cantidad' => 10000,
            'unidad' => 'und',
            'precio_unitario' => 0.35,
        ]);

        Etapa::create([
            'proyecto_id' => $proyecto1->id,
            'nombre' => 'Diseño',
            'descripcion' => 'Elaboración de planos arquitectónicos',
            'estado' => 'completado',
            'fecha_inicio' => '2025-01-15',
            'fecha_fin' => '2025-02-28',
        ]);

        Etapa::create([
            'proyecto_id' => $proyecto1->id,
            'nombre' => 'Construcción',
            'descripcion' => 'Ejecución de obra civil',
            'estado' => 'en_progreso',
            'fecha_inicio' => '2025-03-01',
            'fecha_fin' => '2025-10-31',
        ]);

        Etapa::create([
            'proyecto_id' => $proyecto2->id,
            'nombre' => 'Diseño',
            'descripcion' => 'Elaboración de planos',
            'estado' => 'en_progreso',
            'fecha_inicio' => '2025-03-01',
            'fecha_fin' => '2025-04-30',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Criador;

class CriadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Criador::create([
            'numeroCriador' => 'IZ071',
            'nombre' => 'Antonio',
            'apellidos' => 'Ortiz Granados',
            'fechaNacimiento' => '2003-11-23',
            'localidad' => 'Baena',
            'password' => 'adminadmin',
            'email' => 'antonioortizgranados@gmail.com',
            'telefono' => 606712952,
            'esAdmin' => true,
        ]);
    }
}

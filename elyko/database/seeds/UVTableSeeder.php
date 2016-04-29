<?php
use App\Uv;
use Illuminate\Database\Seeder;

class UVTableSeeder extends Seeder
{
    public function run()
    {

        Uv::create(['name' => 'Maths',
            'credits' => 5,
            'semester' => 'A1S2']);

        Uv::create(['name' => 'Physique',
            'credits' => 3,
            'semester' => 'A1S2']);

        Uv::create(['name' => 'SSG',
            'credits' => 2,
            'semester' => 'A1S2']);

        Uv::create(['name' => 'Langues Vivantes',
            'credits' => 2,
            'semester' => 'A1S2']);

        Uv::create(['name' => 'Sport',
            'credits' => 4,
            'semester' => 'A1S2']);

        Uv::create(['name' => 'Stage Op�rateur',
            'credits' => 2,
            'semester' => 'A1S2']);

        Uv::create(['name' => 'Calcul Scientifique',
            'credits' => 4,
            'semester' => 'A1S2']);

        Uv::create(['name' => 'Projet Prime',
            'credits' => 2,
            'semester' => 'A1S2']);

        Uv::create(['name' => 'PES',
            'credits' => 4,
            'semester' => 'A1S2']);

        Uv::create(['name' => 'Programmation',
            'credits' => 5,
            'semester' => 'A1S2']);

    }
}
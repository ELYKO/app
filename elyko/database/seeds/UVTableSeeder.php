<?php
use App\Uv;
use Illuminate\Database\Seeder;

class UVTableSeeder extends Seeder
{
    public function run()
    {

        Uv::create(['id' => 1,'name' => 'Maths',
            'credits' => 5,
            'semester' => 'A1S2']);

        Uv::create(['id' => 2,'name' => 'Physique',
            'credits' => 3,
            'semester' => 'A1S2']);

        Uv::create(['id' => 3,'name' => 'SSG',
            'credits' => 2,
            'semester' => 'A1S2']);

        Uv::create(['id' => 4,'name' => 'Langues Vivantes',
            'credits' => 2,
            'semester' => 'A1S2']);

        Uv::create(['id' => 5,'name' => 'Sport',
            'credits' => 4,
            'semester' => 'A1S2']);

        Uv::create(['id' => 6,'name' => 'Stage Opérateur',
            'credits' => 2,
            'semester' => 'A1S2']);

        Uv::create(['id' => 7,'name' => 'Calcul Scientifique',
            'credits' => 4,
            'semester' => 'A1S2']);

        Uv::create(['id' => 8,'name' => 'Projet Prime',
            'credits' => 2,
            'semester' => 'A1S2']);

        Uv::create(['id' => 9,'name' => 'PES',
            'credits' => 4,
            'semester' => 'A1S2']);

        Uv::create(['id' => 10,'name' => 'Programmation',
            'credits' => 5,
            'semester' => 'A1S2']);

    }
}
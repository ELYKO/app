<?php
use Illuminate\Database\Seeder;
use App\Student;

class StudentTableSeeder extends Seeder
{
    public function run()
    {

        Student::create(['last_name' => 'Barre',
            'name' => 'Arnaud',
            'email' => 'arnaud.barre@etudiant.mines-nantes.fr',
            'login' => 'abarre14']);

        Student::create(['last_name' => 'Fitoussi',
            'name' => 'Simon',
            'email' => 'simon.fitoussi@etudiant.mines-nantes.fr',
            'login' => 'sfitou14']);

        Student::create(['last_name' => 'Bigault',
            'name' => 'Tom',
            'email' => 'tom.bigault@etudiant.mines-nantes.fr',
            'login' => 'tbigau14']);

        Student::create(['last_name' => 'Negre',
            'name' => 'Youri',
            'email' => 'youri.negre@etudiant.mines-nantes.fr',
            'login' => 'ynegre14']);

        Student::create(['last_name' => 'Seckinger',
            'name' => 'Etienne',
            'email' => 'etienne.seckinger@etudiant.mines-nantes.fr',
            'login' => 'esecki14']);

        Student::create(['last_name' => 'Rault',
            'name' => 'Tim',
            'email' => 'tim.rault@etudiant.mines-nantes.fr',
            'login' => 'trault14']);

        Student::create(['last_name' => 'Cuervo',
            'name' => 'Sebastian',
            'email' => 'sebastian.cuervo@etudiant.mines-nantes.fr',
            'login' => 'scuerv14']);

    }
}
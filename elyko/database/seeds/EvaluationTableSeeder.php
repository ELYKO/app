<?php
use App\Evaluation;
use Illuminate\Database\Seeder;

class EvaluationTableSeeder extends Seeder
{
    public function run()
    {

        Evaluation::create([
            'uv_id' => 1,
            'name' => 'Probas',
            'coefficient' => 0.4,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 1,
            'name' => 'Analyse',
            'coefficient' => 0.5,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 1,
            'name' => 'DM Maths',
            'coefficient' => 0.1,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 2,
            'name' => 'Fluide et thermique',
            'coefficient' => 0.5,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 2,
            'name' => 'Thermodynamique',
            'coefficient' => 0.5,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 3,
            'name' => 'Th�ori des orgas',
            'coefficient' => 0.4,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 3,
            'name' => 'Histoire des ing�s',
            'coefficient' => 0.4,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 3,
            'name' => 'Expos� SSG',
            'coefficient' => 0.2,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 4,
            'name' => 'Egg Race',
            'coefficient' => 0.2,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 4,
            'name' => 'Describe a process',
            'coefficient' => 0.3,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 4,
            'name' => 'English : Oral',
            'coefficient' => 0.2,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 4,
            'name' => 'Deutsch : Oral',
            'coefficient' => 0.2,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 4,
            'name' => 'Deutsch : Ecrit',
            'coefficient' => 0.1,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 4,
            'name' => 'Spanish : Oral',
            'coefficient' => 0.2,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 4,
            'name' => 'Spanish : Ecrit',
            'coefficient' => 0.1,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 4,
            'name' => 'Chinese : Oral',
            'coefficient' => 0.2,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 4,
            'name' => 'Chinese : Ecrit',
            'coefficient' => 0.1,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 5,
            'name' => 'cycle 1 escalade',
            'coefficient' => 0.5,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 5,
            'name' => 'cycle 1 rugby',
            'coefficient' => 0.5,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 5,
            'name' => 'cycle 2 handball',
            'coefficient' => 0.5,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 5,
            'name' => 'cycle 2 natation',
            'coefficient' => 0.5,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 6,
            'name' => 'Soutenance Stage',
            'coefficient' => 0.8,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 6,
            'name' => 'Note tuteur',
            'coefficient' => 0.2,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 7,
            'name' => 'calcul var',
            'coefficient' => 0.4,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 7,
            'name' => 'Matlab',
            'coefficient' => 0.6,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 8,
            'name' => 'Rapport Prime',
            'coefficient' => 0.4,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 8,
            'name' => 'Soutenace Prime',
            'coefficient' => 0.6,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 9,
            'name' => 'Soutenance PES',
            'coefficient' => 1.0,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 10,
            'name' => 'Prog eval 1',
            'coefficient' => 0.5,
            'locked' => false
        ]);

        Evaluation::create([
            'uv_id' => 10,
            'name' => 'Prog eval 2',
            'coefficient' => 0.5,
            'locked' => false
        ]);

    }
}
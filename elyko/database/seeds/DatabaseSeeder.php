<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StudentTableSeeder::class);
        $this->call(UVTableSeeder::class);
        $this->call(EvaluationTableSeeder::class);
        $this->call(StudentUVTableSeeder::class);
        $this->call(EvaluationStudentTableSeeder::class);

    }
}

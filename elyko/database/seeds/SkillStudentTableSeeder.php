<?php

use App\SkillAssessed;
use Illuminate\Database\Seeder;

class SkillStudentTableSeeder extends Seeder
{
    public function run()
    {
        SkillAssessed::create(['skill_id' => 11,'student_id' => 7,'value' => '+']);
        SkillAssessed::create(['skill_id' => 12,'student_id' => 7,'value' => '-']);
        SkillAssessed::create(['skill_id' => 12,'student_id' => 7,'value' => '+']);
        SkillAssessed::create(['skill_id' => 15,'student_id' => 7,'value' => '+']);
        SkillAssessed::create(['skill_id' => 17,'student_id' => 7,'value' => '+']);
        SkillAssessed::create(['skill_id' => 18,'student_id' => 7,'value' => '=']);
        SkillAssessed::create(['skill_id' => 18,'student_id' => 7,'value' => '+']);
        SkillAssessed::create(['skill_id' => 23,'student_id' => 7,'value' => '+']);
        SkillAssessed::create(['skill_id' => 24,'student_id' => 7,'value' => '+']);
        SkillAssessed::create(['skill_id' => 26,'student_id' => 7,'value' => '+']);
        SkillAssessed::create(['skill_id' => 26,'student_id' => 7,'value' => '-']);
        SkillAssessed::create(['skill_id' => 29,'student_id' => 7,'value' => '+']);
        SkillAssessed::create(['skill_id' => 29,'student_id' => 7,'value' => '=']);
        SkillAssessed::create(['skill_id' => 29,'student_id' => 7,'value' => '+']);
        SkillAssessed::create(['skill_id' => 31,'student_id' => 7,'value' => '+']);
        SkillAssessed::create(['skill_id' => 31,'student_id' => 7,'value' => '+']);
        SkillAssessed::create(['skill_id' => 33,'student_id' => 7,'value' => '=']);
        SkillAssessed::create(['skill_id' => 35,'student_id' => 7,'value' => '=']);
        SkillAssessed::create(['skill_id' => 36,'student_id' => 7,'value' => '=']);
        SkillAssessed::create(['skill_id' => 38,'student_id' => 7,'value' => '-']);
        SkillAssessed::create(['skill_id' => 38,'student_id' => 7,'value' => '-']);
        SkillAssessed::create(['skill_id' => 45,'student_id' => 7,'value' => '=']);
        SkillAssessed::create(['skill_id' => 45,'student_id' => 7,'value' => '=']);
        SkillAssessed::create(['skill_id' => 47,'student_id' => 7,'value' => '=']);
        SkillAssessed::create(['skill_id' => 48,'student_id' => 7,'value' => '-']);
        SkillAssessed::create(['skill_id' => 49,'student_id' => 7,'value' => '=']);
    }
}
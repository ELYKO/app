<?php

namespace App\Http\Controllers;

use App\SkillAssessed;
use App\Student;

class SkillController extends Controller
{
    public function get($login, $semester) {
        $studentId = Student::where(['login'=>$login])->first()->id;
        $detail = array('IGA'=>array(50,0),'IGB'=>array(50,0),'interpA'=>array(50,0),'interpB'=>array(50,0),'intraA'=>array(50,0),'intraB'=>array(50,0),'intraC'=>array(50,0), 'STA'=>array(50,0), 'STB'=>array(50,0), 'STC'=>array(50,0));
        $assessments = SkillAssessed::where(['student_id'=>$studentId])->join('skills','skill_student.skill_id', '=', 'skills.id')->where(['semester'=>$semester])->get();
        foreach ($assessments as $assessment) {
           $name = $assessment->name;
           $value = $this->symbolToDigits($assessment->value);
           $detail[$name][1]++;
           $detail[$name][0] =  round(($detail[$name][0] * ($detail[$name][1]-1) + $value)/$detail[$name][1],1);
        }
        return response()->json($detail);
    }
    
    function symbolToDigits($value) {
        switch ($value) {
            case "+" : $digit = 100; break;
            case "-" : $digit = 0; break;
            default : $digit = 50;
        }
        return $digit;
    }
}
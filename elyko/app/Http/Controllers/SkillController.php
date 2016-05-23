<?php

namespace App\Http\Controllers;

use App\SkillAssessed;
use App\Student;

class SkillController extends Controller
{
    public function get($semester) {
        $studentId = Student::where(['login'=>$_SERVER["PHP_AUTH_USER"]])->first()->id;
        $detail = array('IGA'=>array(1,0),'IGB'=>array(1,0),'interpA'=>array(1,0),'interpB'=>array(1,0),'intraA'=>array(1,0),'intraB'=>array(1,0),'intraC'=>array(1,0), 'STA'=>array(1,0), 'STB'=>array(1,0), 'STC'=>array(1,0));
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
            case "+" : $digit = 2; break;
            case "-" : $digit = 0; break;
            default : $digit = 1;
        }
        return $digit;
    }
}
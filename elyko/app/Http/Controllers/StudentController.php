<?php

namespace App\Http\Controllers;

use App\Student;

class StudentController extends Controller
{

    public function get()
    {
        $student = Student::where(['login' => $_SERVER["PHP_AUTH_USER"]])->first();
        $semesters = array();
        $uvs = $student->uvs()->get();
        foreach ($uvs as $uv) {
            if (!in_array($uv->semester, $semesters))
                array_push($semesters, $uv->semester);
        }
        arsort($semesters);
        $student['semesters'] = array_values($semesters);
        return response()->json($student);
    }
    
}
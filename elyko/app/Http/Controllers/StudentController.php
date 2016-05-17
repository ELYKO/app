<?php

namespace App\Http\Controllers;

use App\Student;

class StudentController extends Controller
{

    public function get($studentLogin, $semester)
    {
        $student_notes = Student::with([
            'uvs'=> function ($query) use ($semester) {
                $query->where('semester', $semester);
            },
            'uvs.evaluations' => function ($query) use ($studentLogin) {
                $query->where('locked', true);
                $query->whereHas('students', function ($query) use ($studentLogin) {
                    $query->where('login', $studentLogin);
                });

            },
            'uvs.evaluations.students' => function ($query) use ($studentLogin) {
                $query->select('note')->where('login', $studentLogin);
            }])->where('login', $studentLogin)->get();

        return response()->json($student_notes);
    }
    
    public function semesters($login) {
        $student = Student::where(['login'=>$login])->first();
        $semesters = array();
        $uvs = $student->uvs()->get();
        foreach ($uvs as $uv) {
            if (!in_array($uv->semester, $semesters))
                array_push($semesters,$uv->semester);
        }
        arsort($semesters);
        return response()->json(array_values($semesters));
    }
}
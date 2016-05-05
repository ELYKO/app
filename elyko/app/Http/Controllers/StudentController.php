<?php

namespace App\Http\Controllers;

use App\Student;

class StudentController extends Controller
{


    public function get($studentLogin)
    {
        $student_notes = Student::with([
            'uvs.evaluations' => function ($query) use ($studentLogin) {
                $query->where('locked', false);
                $query->whereHas('students', function ($query) use ($studentLogin) {
                    $query->where('login', $studentLogin);
                });

            },
            'uvs.evaluations.students' => function ($query) use ($studentLogin) {
                $query->select('note')->where('login', $studentLogin);
            }])->where('login', $studentLogin)->get();

        return response()->json($student_notes);
    }
}
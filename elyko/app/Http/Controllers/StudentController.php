<?php

namespace App\Http\Controllers;

use App\Student;

class StudentController extends Controller
{


    public function get($id)
    {
        $student_notes = Student::with([
            'uvs.evaluations' => function ($query) use ($id) {
                $query->where('locked', false);
                $query->whereHas('students', function ($query) use ($id) {
                    $query->where('login', $id);
                });

            },
            'uvs.evaluations.students' => function ($query) use ($id) {
                $query->select('note')->where('login', $id);
            }])->where('login', $id)->get();

        return response()->json($student_notes);
    }
}
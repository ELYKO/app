<?php

namespace App\Http\Controllers;

use App\Student;

class StudentController extends Controller {
    
    public function get($id) {
        $student = Student::query()->findOrFail($id);
        return response()->json($student);
    }
}
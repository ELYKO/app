<?php

namespace App\Http\Controllers;

use App\Evaluation;
use App\Note;

class EvaluationController extends Controller
{
    public function get($id) {
        $students = Evaluation::find($id)->students;
        $detail = array('A'=>0,'B'=>0,'C'=>0,'D'=>0,'E'=>0,'Fx'=>0,'F'=>0);
        foreach ($students as $student) {
            $note = Note::where(['evaluation_id' => $id, 'student_id' => $student['id']])->first();
            $value = $note['note'];
            if (is_numeric($value))
                $value = $this->digitToLetter($value);
            $detail[$value]++;
        }
        return response()->json($detail);
    }

    public function digitToLetter($note) {
        if ($note<5) return "F";
        else if ($note < 8) return "Fx";
        else if ($note < 10) return "E";
        else if ($note < 12) return "D";
        else if ($note < 14) return "C";
        else if ($note < 17) return "B";
        else return "A";
    }
}
<?php

namespace App\Http\Controllers;

use App\Inscription;
use App\Uv;

class UvController extends Controller
{
    public function get($id) {
        $uv = Uv::find($id);
        $inscriptions = Inscription::where(['uv_id'=>$id])->get();
        $detail = array('average','name'=>$uv->name,
            'ects'=>$uv->credits,'grades'=>array('A'=>0,'B'=>0,'C'=>0,'D'=>0,'E'=>0,'FX'=>0,'F'=>0));
        $total = $gradeNumber = 0;
        foreach ($inscriptions as $inscription) {
            $grade = $inscription['grade'];
            if (array_key_exists($grade, $detail['grades'])) {
                $detail['grades'][$grade]++;
                $total += EvaluationController::letterToDigit($grade);
                $gradeNumber++;
            }
        }
        if ($gradeNumber)
            $detail['average'] = EvaluationController::digitToLetter($total/$gradeNumber);
        return response()->json($detail);
    }
}
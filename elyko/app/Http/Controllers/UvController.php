<?php

namespace App\Http\Controllers;

use App\Inscription;
use App\Uv;

class UvController extends Controller
{
    public function get($id) {
        $uv = Uv::find($id);
        $inscriptions = Inscription::where(['uv_id'=>$id])->get();
        $detail = array('average'=>0,'name'=>$uv->name,
            'ects'=>$uv->credits,'grades'=>array('A'=>0,'B'=>0,'C'=>0,'D'=>0,'E'=>0,'FX'=>0,'F'=>0));
        $total = 0;
        foreach ($inscriptions as $inscription) {
            $grade = $inscription['grade'];
            $detail['grades'][$grade]++;
            $total += $this->letterToDigit($grade);
        }
        $detail['average'] = $this->digitToLetter($total/count($inscriptions));
        return response()->json($detail);
    }

    function digitToLetter($value) {
        if ($value<5) $letter = "F";
        else if ($value < 8) $letter = "FX";
        else if ($value < 10) $letter = "E";
        else if ($value < 12) $letter = "D";
        else if ($value < 14) $letter = "C";
        else if ($value < 17) $letter = "B";
        else $letter = "A";
        return $letter;
    }

    private function letterToDigit($value) {
        switch($value) {
            case "F" : $digit = 2.5; break;
            case "FX" : $digit = 6.5; break;
            case "E" : $digit = 9; break;
            case "D" : $digit = 11; break;
            case "C" : $digit = 13; break;
            case "B" : $digit = 15.5; break;
            default : $digit = 18.5;
        }
        return $digit;
    }
}
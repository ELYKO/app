<?php

namespace App\Http\Controllers;

use App\Evaluation;
use App\Note;

class EvaluationController extends Controller
{
    public function get($id) {
        $evaluation = Evaluation::find($id);
        $notes = Note::where(['evaluation_id' => $id])->get();
        $detail = array('average'=>$this->average($notes),'name'=>$evaluation->name,
            'coefficient'=>$evaluation->coefficient,'notes'=>array('A'=>0,'B'=>0,'C'=>0,'D'=>0,'E'=>0,'FX'=>0,'F'=>0));
        foreach ($notes as $note) {
            $value = $note['note'];
            if (is_numeric($value))
                $value = $this->digitToLetter($value);
            if (array_key_exists($value, $detail['notes']))
                $detail['notes'][$value]++;
        }
        return response()->json($detail);
    }

    function average($notes) {
        $average = $total = $noteNumber = 0;
        $withDigits = false;
        foreach ($notes as $note) {
            $value = $note['note'];
            if (is_numeric($value)) {
                $total += $value;
                $noteNumber++;
                $withDigits = true;
            }
            else if (in_array($value,array("A","B","C","D","E","FX","F"))) {
                $value = $this->letterToDigit($value);
                $total += $value;
                $noteNumber++;
            }
        }
        if ($withDigits && $noteNumber)
            $average = round($total/$noteNumber,2);
        else if ($noteNumber)
            $average = $this->digitToLetter($total/$noteNumber);
        return $average;
    }
    
    public static function digitToLetter($value) {
        if ($value<5) $letter = "F";
        else if ($value < 8) $letter = "FX";
        else if ($value < 10) $letter = "E";
        else if ($value < 12) $letter = "D";
        else if ($value < 14) $letter = "C";
        else if ($value < 17) $letter = "B";
        else $letter = "A";
        return $letter;
    }

    public static function letterToDigit($value) {
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
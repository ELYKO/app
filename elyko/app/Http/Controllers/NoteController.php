<?php

namespace App\Http\Controllers;

use App\Inscription;
use App\Student;

class NoteController
{
    public function get($semester)
    {
        $notes = Student::with(['uvs' => function ($query) use ($semester) {
            $query->where('semester', $semester);
        },
            'uvs.evaluations' => function ($query) {
                $query->where('locked', true);
                $query->whereHas('students', function ($query) {
                    $query->where('login', $_SERVER["PHP_AUTH_USER"]);
                });
                $query->orderBy('id', 'desc');
            },
            'uvs.evaluations.students' => function ($query) {
                $query->select('note')->where('login', $_SERVER["PHP_AUTH_USER"]);
            }])->where('login', $_SERVER["PHP_AUTH_USER"])->get();
        $notes[0]['gpa'] = $this->gpa($semester);
        $uvs = $notes[0]['uvs']->toArray();
        usort($uvs,
            function ($a, $b) {
                if ($a['evaluations'] && $b['evaluations'])
                    return ($a['evaluations'][0]['id'] < $b['evaluations'][0]['id']) ? 1 : -1;
                elseif ($a['evaluations'])
                    return -1;
                else
                    return 1;
            });
        unset($notes[0]['uvs']);
        $notes[0]['uvs'] = $uvs;
        return response()->json($notes);
    }

    function gpa($semester)
    {
        $studentId = Student::where(['login' => $_SERVER["PHP_AUTH_USER"]])->first()->id;
        $uvs = Inscription::where(['student_id' => $studentId])
            ->join('uvs', 'uvs.id', '=', 'student_uv.uv_id')
            ->where(['semester' => $semester])->get();
        $gpa = $total = $totalECTS = 0;
        foreach ($uvs as $uv) {
            $grade = $uv['grade'];
            $credits = $uv['credits'];
            if (!is_numeric($grade))
                $grade = $this->letterToDigit($grade);
            $total += $grade * $credits;
            $totalECTS += $credits;
        }
        if ($totalECTS)
            $gpa = round($total / $totalECTS, 2);
        return $gpa;
    }

    function letterToDigit($grade)
    {
        switch ($grade) {
            case "A" :
                $digit = 4;
                break;
            case "B" :
                $digit = 3.5;
                break;
            case "C" :
                $digit = 3;
                break;
            case "D" :
                $digit = 2.5;
                break;
            case "E" :
                $digit = 2;
                break;
            default :
                $digit = 0;
        }
        return $digit;
    }
}
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Http\Controllers;

$app->get('/', function () {
    return redirect('/index.html');
});

$app->get('/student', 'StudentController@get');
$app->get('/notes/{semester}', 'NoteController@get');
$app->get('/evaluation/{id}', 'EvaluationController@get');
$app->get('/skills/{semester}', 'SkillController@get');
$app->get('/uv/{id}', 'UvController@get');
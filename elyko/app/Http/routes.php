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
    return 'hello world';
});

$app->get('/student/{login}', 'StudentController@get');
$app->get('/student/{login}/semesters', 'StudentController@semesters');
$app->get('/evaluation/{id}', 'EvaluationController@get');
$app->get('/skills/{login}/{semester}', 'SkillController@get');
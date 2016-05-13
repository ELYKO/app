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

$app->get('/student/{id}', 'StudentController@get');
$app->get('/evaluation/{id}', 'EvaluationController@get');
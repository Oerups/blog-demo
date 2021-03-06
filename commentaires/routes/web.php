<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group([], function () use ($router) {
    $router->get('/article/{id}', 'MainController@index');
    $router->delete('/article/{id}', 'MainController@destroyMultiple');
    $router->get('/{id}', 'MainController@show');
    $router->post('/', 'MainController@store');
    $router->put('/{id}', 'MainController@update');
    $router->patch('/{id}', 'MainController@patch');
    $router->delete('/{id}', 'MainController@destroy');
});

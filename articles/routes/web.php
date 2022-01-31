<?php

use Google\Cloud\Firestore\FirestoreClient;
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

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/', 'ArticleController@index');
    $router->get('/{id}', 'ArticleController@show');
    $router->post('/', 'ArticleController@store');
    $router->put('/{id}', 'ArticleController@update');
    $router->patch('/{id}', 'ArticleController@patch');
    $router->delete('/{id}', 'ArticleController@destroy');
});

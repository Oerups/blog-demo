<?php

use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Facades\Route;

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

//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Methods: GET,HEAD,PUT,POST,DELETE,PATCH,OPTIONS");
//header("Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization");
//Route::options("/{any:.*}", [
//    function (){
//        return response(["status" => "success"]);
//    }
//]
//);

$router->group([], function () use ($router) {
    $router->get('/', 'ArticleController@index');
    $router->get('/{id}', 'ArticleController@show');
    $router->post('/', 'ArticleController@store');
    $router->put('/{id}', 'ArticleController@update');
    $router->patch('/{id}', 'ArticleController@patch');
    $router->delete('/{id}', 'ArticleController@destroy');
});

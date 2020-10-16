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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/api', function () {
    return response()->json(['message' => 'API works and well served!']);
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/login', 'AuthController@authenticate');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    // roles
    $router->group(['prefix' => 'roles'], function () use ($router) {
        $router->get('/', 'RolesController@index');
        $router->get('/{id}', 'RolesController@show');
        $router->post('/', 'RolesController@store');
        $router->put('/{id}', 'RolesController@update');
        $router->delete('/{id}', 'RolesController@destroy');
    });

    // roles
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('/', 'UserController@index');
        $router->get('/{id}', 'UserController@show');
        $router->post('/', 'UserController@store');
        $router->put('/{id}', 'UserController@update');
        $router->delete('/{id}', 'UserController@destroy');
    });
});
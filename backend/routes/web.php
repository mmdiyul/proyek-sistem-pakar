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
    $router->group(['middleware' => 'auth'], function () use ($router) {
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

        // symptoms
        $router->group(['prefix' => 'symptoms'], function () use ($router) {
            $router->get('/', 'SymptomsController@index');
            $router->get('/{id}', 'SymptomsController@show');
            $router->post('/', 'SymptomsController@store');
            $router->put('/{id}', 'SymptomsController@update');
            $router->delete('/{id}', 'SymptomsController@destroy');
        });
    
        // symptoms
        $router->group(['prefix' => 'users'], function () use ($router) {
            $router->get('/', 'UserController@index');
            $router->get('/{id}', 'UserController@show');
            $router->post('/', 'UserController@store');
            $router->put('/{id}', 'UserController@update');
            $router->delete('/{id}', 'UserController@destroy');
        });

        // diseases
        $router->group(['prefix' => 'diseases'], function () use ($router) {
            $router->get('/', 'DiseasesController@index');
            $router->get('/{id}', 'DiseasesController@show');
            $router->post('/', 'DiseasesController@store');
            $router->put('/{id}', 'DiseasesController@update');
            $router->delete('/{id}', 'DiseasesController@destroy');
        });
    
        // diseases
        $router->group(['prefix' => 'users'], function () use ($router) {
            $router->get('/', 'UserController@index');
            $router->get('/{id}', 'UserController@show');
            $router->post('/', 'UserController@store');
            $router->put('/{id}', 'UserController@update');
            $router->delete('/{id}', 'UserController@destroy');
        });

        // diseaseRules
        $router->group(['prefix' => 'disease-rules'], function () use ($router) {
            $router->get('/', 'DiseaseRulesController@index');
            $router->get('/{id}', 'DiseaseRulesController@show');
            $router->post('/', 'DiseaseRulesController@store');
            $router->put('/{id}', 'DiseaseRulesController@update');
            $router->delete('/{id}', 'DiseaseRulesController@destroy');
        });
    
        // diseaseRules
        $router->group(['prefix' => 'users'], function () use ($router) {
            $router->get('/', 'UserController@index');
            $router->get('/{id}', 'UserController@show');
            $router->post('/', 'UserController@store');
            $router->put('/{id}', 'UserController@update');
            $router->delete('/{id}', 'UserController@destroy');
        });

        // diagnosisHistory
        $router->group(['prefix' => 'diagnosis-history'], function () use ($router) {
            $router->get('/', 'DiagnosisHistoryController@index');
            $router->get('/{id}', 'DiagnosisHistoryController@show');
            $router->post('/', 'DiagnosisHistoryController@store');
            $router->put('/{id}', 'DiagnosisHistoryController@update');
            $router->delete('/{id}', 'DiagnosisHistoryController@destroy');
        });
    
        // diagnosisHistory
        $router->group(['prefix' => 'users'], function () use ($router) {
            $router->get('/', 'UserController@index');
            $router->get('/{id}', 'UserController@show');
            $router->post('/', 'UserController@store');
            $router->put('/{id}', 'UserController@update');
            $router->delete('/{id}', 'UserController@destroy');
        });
    });
});
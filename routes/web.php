<?php

use App\Http\Controllers\WargaController;



$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/warga', 'WargaController@index');
$router->post('/warga', 'WargaController@store');
$router->get('/warga/{id}', 'WargaController@show');
$router->put('/warga/{id}', 'WargaController@update');
$router->delete('/warga/{id}', 'WargaController@destroy');

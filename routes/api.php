<?php

// ciutats
$router->get('/ciutats', 'Api\CiutatApiController@index');
$router->get('/ciutats/{id}', 'Api\CiutatApiController@show');
$router->post('/ciutats', 'Api\CiutatApiController@store');

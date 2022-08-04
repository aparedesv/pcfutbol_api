<?php

// ciutats
$router->get('/ciutats', 'Api\CiutatApiController@index');
$router->get('/ciutats/{id}', 'Api\CiutatApiController@show');
$router->post('/ciutats', 'Api\CiutatApiController@store');
$router->put('/ciutats/{id}', 'Api\CiutatApiController@update');
$router->delete('/ciutats/{id}', 'Api\CiutatApiController@destroy');
// clubs
$router->get('/clubs', 'Api\ClubApiController@index');
$router->get('/clubs/{id}', 'Api\ClubApiController@show');
$router->post('/clubs', 'Api\ClubApiController@store');
$router->put('/clubs/{id}', 'Api\ClubApiController@update');
$router->delete('/clubs/{id}', 'Api\ClubApiController@destroy');
// equips
$router->get('/equips', 'Api\EquipApiController@index');
$router->get('/equips/{id}', 'Api\EquipApiController@show');
$router->post('/equips', 'Api\EquipApiController@store');
$router->put('/equips/{id}', 'Api\EquipApiController@update');
$router->delete('/equips/{id}', 'Api\EquipApiController@destroy');

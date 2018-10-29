<?php
//Get all authors - GET /api/authors
//Get one author - GET /api/authors/23
//Create an author - POST /api/authors
//Edit an author - PUT /api/authors/23
//Delete an author - DELETE /api/authors/23

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->post('auth/login', ['uses' => 'v1\cms\AuthController@authenticate']);

$router->group(['prefix' => 'v1/cms','middleware' => 'jwt.auth'],function () use ($router){
    $router->get('/users/getAll',['uses' => 'v1\cms\UserController@getAll']);
    $router->post('/users/getById',['uses' => 'v1\cms\UserController@getById']);
    $router->post('/users/create',['uses' => 'v1\cms\UserController@create']);
    $router->post('/users/update',['uses' => 'v1\cms\UserController@update']);
    //
    $router->post('/properties/create',['uses' => 'v1\cms\PropertyController@create']);
});
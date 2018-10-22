<?php
//Get all authors - GET /api/authors
//Get one author - GET /api/authors/23
//Create an author - POST /api/authors
//Edit an author - PUT /api/authors/23
//Delete an author - DELETE /api/authors/23

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1'],function () use ($router){
    $router->get('/cms/users/getAll',['uses' => 'v1\cms\UserController@getAll']);
    $router->post('/cms/users/getById',['uses' => 'v1\cms\UserController@getById']);
    $router->post('/cms/users/create',['uses' => 'v1\cms\UserController@create']);
    $router->post('/cms/users/update',['uses' => 'v1\cms\UserController@update']);
});
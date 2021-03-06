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
    $router->post('/ui/accounts/login',['uses' => 'v1\ui\AccountController@login']);
    $router->post('/ui/accounts/register',['uses' => 'v1\ui\AccountController@register']);

});
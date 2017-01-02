<?php

$app->get('/users', 'UserController:index');
$app->post('/users', 'UserController:create');
$app->get('/users/{id}', 'UserController:show');
$app->post('/users/{id}', 'UserController:update');
$app->post('/users/{id}/permissions', 'UserController:permissions');
$app->delete('/users/{id}', 'UserController:delete');

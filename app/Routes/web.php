<?php

/**
 * Centrailized Routes
 * $router->add(Method, URI, Controller@Method)
 */

$router->add('GET', '/', 'AuthController@showLogin');
$router->add('GET', '/login', 'AuthController@showLogin');
$router->add('POST', '/login', 'AuthController@login');
$router->add('GET', '/logout', 'AuthController@logout');

$router->add('GET', '/dashboard', 'DashboardController@index');

// User CRUD Routes
$router->add('GET', '/users', 'UserController@index');
$router->add('GET', '/users/form', 'UserController@form');
$router->add('POST', '/users/store', 'UserController@store');
$router->add('POST', '/users/update', 'UserController@update');
$router->add('GET', '/users/delete', 'UserController@delete');

// API Routes
$router->add('GET', '/api/users', 'ApiController@getUsers');

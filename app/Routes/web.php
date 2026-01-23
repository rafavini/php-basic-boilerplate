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

// API Routes
$router->add('GET', '/api/users', 'ApiController@getUsers');

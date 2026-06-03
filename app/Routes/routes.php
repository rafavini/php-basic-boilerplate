<?php

/**
 * Rotas — RBAC pelo modelo do vídeo "Most Developers Design Permissions Wrong"
 *
 * Regra de ouro: o Router verifica PERMISSION, nunca role.
 *
 *   $router->add(METHOD, URI, 'Controller@action', 'permission.name')
 *   $router->add(METHOD, URI, 'Controller@action', null)  →  pública
 *
 * Quem pode fazer o quê fica na tabela permission_role do banco,
 * não hardcoded aqui.
 */

// Públicas
$router->add('GET',  '/login',  'AuthController@loginForm');
$router->add('POST', '/login',  'AuthController@login');
$router->add('GET',  '/logout', 'AuthController@logout');
$router->add('GET',  '/403',    'ErrorController@forbidden');

// Dashboard  (qualquer autenticado)
$router->add('GET', '/dashboard', 'DashboardController@index');

// Sample CRUD
$router->add('GET',  '/',              'SampleController@index',  'sample.read');
$router->add('GET',  '/sample/form',   'SampleController@form',   'sample.create');
$router->add('POST', '/sample/save',   'SampleController@save',   'sample.create');
$router->add('GET',  '/sample/delete', 'SampleController@delete', 'sample.delete');

// Gestão de usuários
$router->add('GET',  '/users',        'UserController@index',  'user.read');
$router->add('GET',  '/users/form',   'UserController@form',   'user.create');
$router->add('POST', '/users/save',   'UserController@save',   'user.create');
$router->add('GET',  '/users/delete', 'UserController@delete', 'user.delete');


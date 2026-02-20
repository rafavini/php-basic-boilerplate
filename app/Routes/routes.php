<?php

/**
 * Centrailized Routes
 * Didactic Example for Students
 */

// Sample CRUD Routes (The only routes in the system now)
$router->add('GET', '/', 'SampleController@index');
$router->add('GET', '/sample/form', 'SampleController@form');
$router->add('POST', '/sample/save', 'SampleController@save');
$router->add('GET', '/sample/delete', 'SampleController@delete');

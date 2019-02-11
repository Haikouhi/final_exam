<?php

$routes = new Router;

$routes->get('/vehicules',                                     'VehiculesController@index');
$routes->get('/vehicules/(\d+)',                               'VehiculesController@show');
$routes->get('/vehicules/add',                                 'VehiculesController@add');
$routes->post('/vehicules/save',                               'VehiculesController@save');
$routes->get('/vehicules/(\d+)/edit',                          'VehiculesController@edit');
$routes->get('/vehicules/(\d+)/delete',                        'VehiculesController@delete');

$routes->get('/conducteurs',                                   'ConducteursController@index');
$routes->get('/conducteurs/(\d+)',                             'ConducteursController@show');
$routes->get('/conducteurs/add',                               'ConducteursController@add');
$routes->post('/conducteurs/save',                             'ConducteursController@save');
$routes->get('/conducteurs/(\d+)/edit',                        'ConducteursController@edit');
$routes->get('/conducteurs/(\d+)/delete',                      'ConducteursController@delete');

$routes->get('/boths',                                          'BothController@index');
$routes->get('/boths/add',                                      'BothController@add');
$routes->post('/boths/save',                                    'BothController@save');
$routes->get('/boths/(\d+)/delete',                             'BothController@delete');

$routes->get('/',                                              'PagesController@home');
$routes->get('/divers',                                        'PagesController@divers');

$routes->run();
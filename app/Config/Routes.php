<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;
use Config\Services;

/** @var RouteCollection $routes */
$routes = Services::routes();

$routes->get('/', 'AuthController::login');

$routes->get('login', 'AuthController::login');
$routes->post('autenticar', 'AuthController::autenticar');
$routes->get('cadastro', 'AuthController::cadastro');
$routes->post('registrar', 'AuthController::registrar');
$routes->get('login/logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('feed', 'PostController::index');
    $routes->get('postagens/create', 'PostController::create');
    $routes->post('postagens/store', 'PostController::store');
    $routes->get('postagens/(:num)', 'PostController::show/$1');
    $routes->get('postagens/delete/(:num)', 'PostController::delete/$1');
    $routes->get('postagens/edit/(:num)', 'PostController::edit/$1');
    $routes->post('postagens/update/(:num)', 'PostController::update/$1');

    $routes->get('likes/toggle/(:num)', 'LikeController::toggle/$1');

    $routes->post('comentarios/store', 'ComentarioController::store');
    $routes->get('comentarios/delete/(:num)', 'ComentarioController::delete/$1');

    $routes->get('perfil/(:num)', 'UsuarioController::perfil/$1');
    $routes->get('settings', 'UsuarioController::settings');

    $routes->post('usuario/update', 'UsuarioController::update');

    $routes->get('usuario/toggleFollow/(:num)', 'UsuarioController::toggleFollow/$1');
});



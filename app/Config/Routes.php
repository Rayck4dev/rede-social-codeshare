<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;
use Config\Services;

/** @var RouteCollection $routes */
$routes = Services::routes();

// Rota inicial → login
$routes->get('/', 'AuthController::login');

// Autenticação
$routes->get('login', 'AuthController::login');
$routes->post('autenticar', 'AuthController::autenticar');
$routes->get('cadastro', 'AuthController::cadastro');
$routes->post('registrar', 'AuthController::registrar');
$routes->get('logout', 'AuthController::logout');

// Postagens (feed e CRUD)
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('feed', 'PostController::index');
    $routes->get('postagens/create', 'PostController::create');
    $routes->post('postagens/store', 'PostController::store');
    $routes->get('postagens/(:num)', 'PostController::show/$1');
    $routes->get('postagens/delete/(:num)', 'PostController::delete/$1');
    $routes->get('postagens/edit/(:num)', 'PostController::edit/$1');
    $routes->post('postagens/update/(:num)', 'PostController::update/$1');

    // Likes protegidos também
    $routes->post('likes/store', 'LikeController::store');
    $routes->get('likes/delete/(:num)', 'LikeController::delete/$1');
});



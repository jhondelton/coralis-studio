<?php

namespace Config;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth\Auth');
$routes->setDefaultMethod('home');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('/', 'Auth\Auth::home', ['filter' => 'auth']);
$routes->get('email', 'Auth\Auth::sendEmail');
$routes->post('update-avatar', 'Auth\Auth::updateAvatar', ['filter' => 'auth']);

$routes->group('auth', static function ($routes) {
    $routes->get('login', 'Auth\Login::get');
    $routes->post('login', 'Auth\Login::post');
    $routes->get('register', 'Auth\Register::get');
    $routes->post('register', 'Auth\Register::post');
    $routes->get('reset', 'Auth\Reset::get');
    $routes->post('reset', 'Auth\Reset::post');
    $routes->get('reset/(:any)', 'Auth\Reset::get/$1');
    $routes->post('reset/(:any)', 'Auth\Reset::post/$1');
    $routes->get('verify/(:any)', 'Auth\Auth::verify/$1');
    $routes->get('logout', 'Auth\Auth::logout');
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

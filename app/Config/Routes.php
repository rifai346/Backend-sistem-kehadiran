<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('kehadiran', 'KehadiranController::create');
$routes->get('kehadiran', 'KehadiranController::index');
$routes->put('kehadiran/(:num)', 'KehadiranController::update/$1');
$routes->delete('kehadiran/(:num)', 'KehadiranController::delete/$1');


$routes->post('Absensi', 'AbsensiController::create');
$routes->get('Absensi', 'AbsensiController::index');
$routes->put('Absensi/(:num)', 'AbsensiController::update/$1');
$routes->delete('Absensi/(:num)', 'AbsensiController::delete/$1');

$routes->post('Dosen', 'DosenController::create');
$routes->get('Dosen', 'DosenController::index');
$routes->put('Dosen/(:num)', 'DosenController::update/$1');
$routes->delete('Dosen/(:num)', 'DosenController::delete/$1');


$routes->post('Mahasiswa', 'MahasiswaController::create');
$routes->get('Mahasiswa', 'MahasiswaController::index');
$routes->put('Mahasiswa/(:num)', 'MahasiswaController::update/$1');
$routes->delete('Mahasiswa/(:num)', 'MahasiswaController::delete/$1');


$routes->post('Matkul', 'MatkulController::create');
$routes->get('Matkul', 'MatkulController::index');
$routes->put('Matkul/(:num)', 'MatkulController::update/$1');
$routes->delete('Matkul/(:num)', 'MatkulController::delete/$1');

$routes->group('api', ['filter' => 'cors'], function($routes) {
    $routes->options('login', function() { return service('response')->setStatusCode(200); });
    $routes->post('login', 'AuthController::login');
});
$routes->get('dashboard', 'DashboardController::index');

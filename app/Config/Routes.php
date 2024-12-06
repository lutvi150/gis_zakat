<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->set404Override(function () {
    return view('404.php');
});
$routes->get('/', 'Home::index');
$routes->get('logout', 'Home::logout');
$routes->get('login', 'Home::login');
$routes->post('login', 'Home::login_auth');
$routes->group('admin', ['filter' => ['admin']], function (RouteCollection $routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('kelola_zakat', 'Admin::kelola_zakat');
    $routes->get('zakat/add', 'Admin::zakat_add');
    $routes->post('zakat/add', 'Admin::zakat_store');
    $routes->get('zakat/salurkan', 'Admin::zakat_salurkan');
    $routes->post('dokumentasi', 'Admin::upload_dokumentasi');
    $routes->post('dokumentasi/get', 'Admin::dokumentasi');
    $routes->post('dokumentasi/spesifik', 'Admin::one_dokumentasi');
    $routes->get('dokumentasi/delete/(:num)', 'Admin::delete_dokumentasi/$1');
    $routes->post('bantuan/store', 'Admin::bantuan_store');
    // sebaran
    $routes->get('sebaran_penerima', 'Admin::sebaran_penerima');
    $routes->get('sebaran_penerima/get', 'Admin::get_penerima_bantuan');
    // manage data kecamatan
    $routes->get('data-kecamatan', 'Admin::kecamatan');
    //manage data desa
    $routes->get('data-desa/(:num)', 'Admin::desa/$1');
    // persentase penerima
    $routes->get('persentase', 'Admin::persentase_penerima');
    $routes->post('persentase', 'Admin::persentase_penerima_update');
    // new costume zakat add
    $routes->get('zakat-add-data', 'Admin::zakat_add_detail');
    $routes->post('zakat-add-data', 'Admin::zakat_add_detail_store');
    $routes->get('detail-penerima/(:num)/(:num)', 'Admin::data_penerima/$1/$2');
});
$routes->get('convert', 'Admin::convert_database');
$routes->get('desa/(:num)', 'Admin::get_village/$1');
// use for admin in kecamatan

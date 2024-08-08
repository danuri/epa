<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 $routes->get('auth', 'Auth::index');
 $routes->post('auth', 'Auth::login');
 $routes->get('auth/login', 'Auth::login');
 $routes->get('auth/logout', 'Auth::logout');

$routes->get('/', 'Home::index',['filter' => 'auth']);
$routes->get('print/drhi', 'Cetak::index',['filter' => 'auth']);
$routes->get('print/drh', 'Cetak::drh',['filter' => 'auth']);

$routes->group("ajax",['filter' => 'auth'], function ($routes) {
    $routes->get('getkabupaten', 'Ajax::getkabupaten');
    $routes->get('getprofil', 'Ajax::getprofil');
    $routes->get('getsasaranpenyuluh', 'Ajax::getsasaranpenyuluh');
    $routes->get('getmateriopsi', 'Ajax::getmateriopsi');
});

$routes->group("penyuluh",['filter' => 'auth'], function ($routes) {
    $routes->get('', 'Penyuluh::index');
    $routes->get('index/(:num)', 'Penyuluh::index/$1');
    $routes->post('getdata/(:any)', 'Penyuluh::getdata/$1');
    $routes->get('detail/(:any)', 'Penyuluh::detail/$1');
    $routes->get('delete/(:any)', 'Penyuluh::delete/$1');
});

$routes->group("laporan",['filter' => 'auth'], function ($routes) {
    $routes->get('', 'Laporan::index');
    $routes->post('getdata', 'Laporan::getdata');
    $routes->get('detail/(:any)', 'Laporan::detail/$1');
    $routes->get('delete/(:any)', 'Laporan::delete/$1');
    $routes->post('save', 'Laporan::save');
    $routes->get('export/(:num)/(:num)', 'Laporan::laporanexport/$1/$2');

    $routes->get('lain', 'Laporan::lain');
    $routes->post('lain/save', 'Laporan::savelain');
    $routes->post('lain/getdata', 'Laporan::getdatalain');

    $routes->get('rekapitulasi', 'Laporan::rekapitulasi');
    $routes->get('rekapitulasi/(:num)', 'Laporan::rekapitulasi/$1');
    $routes->get('rekapitulasi/export/(:num)/(:num)', 'Laporan::rekapitulasiexport/$1/$2');
});

$routes->group("sasaran",['filter' => 'auth'], function ($routes) {
    $routes->get('umum', 'Sasaran::umum');
    $routes->post('umum/getdata', 'Sasaran::umumgetdata');
    $routes->post('umum/save', 'Sasaran::umumsave');
    $routes->get('umum/delete/(:any)', 'Sasaran::umumdelete/$1');
    $routes->get('khusus', 'Sasaran::khusus');
    $routes->post('khusus/getdata', 'Sasaran::khususgetdata');
    $routes->post('khusus/save', 'Sasaran::khusussave');
    $routes->get('khusus/delete/(:any)', 'Sasaran::khususdelete/$1');
    $routes->get('detail/(:any)', 'Laporan::detail/$1');
    $routes->get('delete/(:any)', 'Laporan::delete/$1');
});

$routes->group("download",['filter' => 'auth'], function ($routes) {
    $routes->get('regulasi', 'Download::regulasi');
    $routes->get('materi', 'Download::materi');
});

$routes->group("users",['filter' => 'auth'], function ($routes) {
    $routes->get('', 'Users::index');
    $routes->post('save', 'Users::save');
    $routes->post('getdata', 'Users::getdata');
    $routes->get('detail/(:any)', 'Users::detail/$1');
    $routes->get('delete/(:any)', 'Users::delete/$1');
});

$routes->get('admin/auth', 'Admin\Auth::index');
$routes->get('admin/auth/callback', 'Admin\Auth::callback');
$routes->get('admin/auth/login', 'Admin\Auth::login');
$routes->get('admin/auth/logout', 'Admin\Auth::logout');

$routes->group("admin/download",['filter' => 'bimasauth'], function ($routes) {
  $routes->get('/', 'Admin\Download::index');
  $routes->get('delete/(:any)', 'Admin\Download::delete/$1');
  $routes->post('save', 'Admin\Download::save');

});

$routes->group("admin",['filter' => 'adminauth'], function ($routes) {


  $routes->get('/', 'Admin\Home::index');

   $routes->group("ajax", function ($routes) {
       $routes->get('getkabupaten', 'Admin\Ajax::getkabupaten');
   });

   $routes->group("rekapitulasi", function ($routes) {
       $routes->get('/', 'Admin\Rekapitulasi::index');
       $routes->get('provinsi/(:num)', 'Admin\Rekapitulasi::provinsi/$1');
   });

   $routes->group("penyuluh", function ($routes) {
       $routes->get('', 'Admin\Penyuluh::index');
       $routes->get('index/(:num)', 'Admin\Penyuluh::index/$1');
       $routes->post('getdata/(:any)', 'Admin\Penyuluh::getdata/$1');
       $routes->get('detail/(:any)', 'Admin\Penyuluh::detail/$1');
       $routes->get('delete/(:any)', 'Admin\Penyuluh::delete/$1');
       $routes->get('export', 'Admin\Penyuluh::export');
   });

   $routes->group("laporan", function ($routes) {
       $routes->get('', 'Admin\Laporan::index');
       $routes->post('getdata', 'Admin\Laporan::getdata');
       $routes->get('detail/(:any)', 'Admin\Laporan::detail/$1');
       $routes->get('terima/(:any)', 'Admin\Laporan::terima/$1');
       $routes->post('tolak/(:any)', 'Admin\Laporan::tolak/$1');
   });

   $routes->group("users", function ($routes) {
       $routes->get('', 'Admin\Users::index');
       $routes->post('save', 'Admin\Users::save');
       $routes->post('getdata', 'Admin\Users::getdata');
       $routes->get('detail/(:any)', 'Admin\Users::detail/$1');
       $routes->get('delete/(:any)', 'Admin\Users::delete/$1');
   });
});

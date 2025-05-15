<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Str;


// Entry point for the application
$router->get('/', function () use ($router) {
    $text = 'Payroll API by PT. Veronique Indonesia — ' . app()->version();
    return response()->json($text);
});

// route for generating a random key string
$router->get('/key', function () {
    return Str::random(32);
});

// Prefix for master data routes
$router->group(['prefix' => '/api/v1/master-data'], function () use ($router) {

    // Group untuk Bagian
    $router->group(['prefix' => 'bagian'], function () use ($router) {
        $router->get('/', ['as' => 'bagian.index', 'uses' => 'BagianController@index']);
        $router->get('/{IdBagian}', ['as' => 'bagian.show', 'uses' => 'BagianController@show']);
        $router->post('/store', ['as' => 'bagian.store', 'uses' => 'BagianController@store']);
        $router->put('/{IdBagian}', ['as' => 'bagian.update', 'uses' => 'BagianController@update']);
        $router->delete('/{IdBagian}', ['as' => 'bagian.destroy', 'uses' => 'BagianController@destroy']);
    });

    // Group untuk Jabatan
    $router->group(['prefix' => 'jabatan'], function () use ($router) {
        $router->get('/', ['as' => 'jabatan.index', 'uses' => 'JabatanController@index']);
        $router->get('/{IdJabatan}', ['as' => 'jabatan.show', 'uses' => 'JabatanController@show']);
        $router->post('/store', ['as' => 'jabatan.store', 'uses' => 'JabatanController@store']);
        $router->put('/{IdJabatan}', ['as' => 'jabatan.update', 'uses' => 'JabatanController@update']);
        $router->delete('/{IdJabatan}', ['as' => 'jabatan.destroy', 'uses' => 'JabatanController@destroy']);
    });

    $router->group(['prefix' => 'seragam-karyawan'], function () use ($router) {
        $router->get('/', ['as' => 'seragamkaryawan.index', 'uses' => 'SeragamController@index']);
        $router->get('/{IdSeragam}', ['as' => 'seragamkaryawan.show', 'uses' => 'SeragamController@show']);
        $router->post('/store', ['as' => 'seragamkaryawan.store', 'uses' => 'SeragamController@store']);
        $router->put('/{IdSeragam}', ['as' => 'seragamkaryawan.update', 'uses' => 'SeragamController@update']);
        $router->delete('/{IdSeragam}', ['as' => 'seragamkaryawan.destroy', 'uses' => 'SeragamController@destroy']);
    });

    // Group untuk Karyawan
    $router->group(['prefix' => 'karyawan'], function () use ($router) {
        $router->get('/', ['as' => 'karyawan.index', 'uses' => 'KaryawanController@index']);
        $router->get('/{IdKaryawan}', ['as' => 'karyawan.show', 'uses' => 'KaryawanController@show']);
        $router->post('/store', ['as' => 'karyawan.store', 'uses' => 'KaryawanController@store']);
        $router->put('/{IdKaryawan}', ['as' => 'karyawan.update', 'uses' => 'KaryawanController@update']);
        $router->delete('/{IdKaryawan}', ['as' => 'karyawan.destroy', 'uses' => 'KaryawanController@destroy']);
    });

    // Group untuk Karyawan Keluar
    $router->group(['prefix' => 'karyawan-keluar'], function () use ($router) {
        $router->get('/', ['as' => 'karyawankeluar.index', 'uses' => 'KaryawanKeluarController@index']);
        $router->get('/{IdKeluar}', ['as' => 'karyawankeluar.show', 'uses' => 'KaryawanKeluarController@show']);
        $router->post('/store', ['as' => 'karyawankeluar.store', 'uses' => 'KaryawanKeluarController@store']);
        $router->put('/{IdKeluar}', ['as' => 'karyawankeluar.update', 'uses' => 'KaryawanKeluarController@update']);
        $router->delete('/{IdKeluar}', ['as' => 'karyawankeluar.destroy', 'uses' => 'KaryawanKeluarController@destroy']);
    });
});

// Prefix for laporan routes
$router->group(
    ['prefix' => '/api/v1/laporan'],
    function () use ($router) {
        $router->group(['prefix' => 'absensi'], function () use ($router) {
            $router->get('/harian-jam', ['as' => 'laporanharianjam.index', 'uses' => 'LaporanAbsensiJamController@index']);
            $router->get('/harian-jam/{IdBagian}/{TglMasuk}', ['as' => 'laporanharianjam.show', 'uses' => 'LaporanAbsensiJamController@show']);
        });
    }
);

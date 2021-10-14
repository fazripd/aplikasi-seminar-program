<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/index', function() {
    return view('layouts.apps');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/transaksi', 'TransaksiController@index')->name('transaksi');
Route::post('/transaksi/store', 'TransaksiController@store');
Route::get('/gettabletransaksi', 'TransaksiController@gettable');
Route::get('/sumtable', 'TransaksiController@sum');
Route::get('/laporan', 'TransaksiController@laporan')->name('laporan');
Route::get('/gettanggaltransaksi', 'TransaksiController@gettanggal');
Route::get('/transaksi/buka/{id}', 'TransaksiController@buka')->name('laporan');
Route::get('/kurir', 'KurirController@index')->name('kurir');
Route::get('/kurir/create', 'KurirController@create');
Route::post('/kurir/store', 'KurirController@store');
Route::get('/kurir/delete/{id}', 'KurirController@destroy');

Route::get('/cetak_pdf/{id}', 'TransaksiController@cetak_pdf');

Route::get('/barang', 'BarangController@index')->name('barang');
Route::get('/barang/create', 'BarangController@create');
Route::post('/barang/store', 'BarangController@store');

Route::get('/laporan/download/{id1}/{id2}', 'TransaksiController@download');

//jquery
Route::get('/barang/harga', 'TransaksiController@harga');













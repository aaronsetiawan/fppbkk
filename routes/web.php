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

Route::get('/rekapBiaya', function () {
    return view('rekapBiaya');
});

Route::get('/rekapPeserta', function () {
    return view('rekapPeserta');
});

Route::get('/', ['as' => 'index4', 'uses' => 'DashboardController@index']);

Route::group(['prefix' => 'rekapbiaya'], function() {
 Route::get('/', ['as' => 'rekapbiaya', 'uses' => 'RekapBiayaController@index']);
 Route::get('show/{id}', 'RekapBiayaController@show');
 Route::get('showrekapbulan', 'RekapBiayaController@showrekapbulan');
});


Route::group(['prefix' => 'jabatan'], function() {
	Route::get('/', ['as' => 'jabatan', 'uses' => 'JabatanController@index']);
	Route::get('tambah', 'JabatanController@create');
	Route::post('store', 'JabatanController@store');
	Route::get('edit/{id}', 'JabatanController@edit');
	Route::post('update/{id}', 'JabatanController@update');
	Route::post('delete/{id}', 'JabatanController@destroy');
	Route::get('show/{id}', 'JabatanController@show');
	Route::get('tambahKompetensi', 'JabatanController@tambahKompetensi');
	Route::post('storeKompetensi/{id}', 'JabatanController@storeKompetensi');
	Route::get('editKompetensi/{iddept}/{id}', 'JabatanController@editKompetensi');
	Route::post('updateKompetensi/{iddept}/{id}', 'JabatanController@updateKompetensi');
	Route::post('deleteKompetensi/{id}', 'JabatanController@destroyKompetensi');
});

Route::group(['prefix' => 'pegawai'], function() {
	Route::get('/', ['as' => 'pegawai', 'uses' => 'PegawaiController@index']);
	Route::get('tambah', 'PegawaiController@create');
	Route::post('store', 'PegawaiController@store');
	Route::get('edit/{id}', 'PegawaiController@edit');
	Route::post('update/{id}', 'PegawaiController@update');
	Route::post('delete/{id}', 'PegawaiController@destroy');
	Route::get('showKD/{id}', 'PegawaiController@showKD');
	Route::get('showKJ/{id}', 'PegawaiController@showKJ');
});

Route::group(['prefix' => 'media'], function() {
	Route::get('/', ['as' => 'media', 'uses' => 'MediaController@index']);
	Route::get('tambah', 'MediaController@create');
	Route::post('store', 'MediaController@store');
	Route::get('edit/{id}', 'MediaController@edit');
	Route::post('update/{id}', 'MediaController@update');
	Route::post('delete/{id}', 'MediaController@destroy');
});

Route::group(['prefix' => 'topik'], function() {
	Route::get('/', ['as' => 'topik', 'uses' => 'TopikController@index']);
	Route::get('tambah', 'TopikController@create');
	Route::post('store', 'TopikController@store');
	Route::get('edit/{id}', 'TopikController@edit');
	Route::post('update/{id}', 'TopikController@update');
	Route::post('delete/{id}', 'TopikController@destroy');
});

Route::group(['prefix' => 'penyelenggara'], function() {
	Route::get('/', ['as' => 'penyelenggara', 'uses' => 'PenyelenggaraController@index']);
	Route::get('tambah', 'PenyelenggaraController@create');
	Route::post('store', 'PenyelenggaraController@store');
	Route::get('edit/{id}', 'PenyelenggaraController@edit');
	Route::post('update/{id}', 'PenyelenggaraController@update');
	Route::post('delete/{id}', 'PenyelenggaraController@destroy');
});

Route::group(['prefix' => 'direktorat'], function() {
	Route::get('/', ['as' => 'direktorat', 'uses' => 'DirektoratController@index']);
	Route::get('tambah', 'DirektoratController@create');
	Route::post('store', 'DirektoratController@store');
	Route::get('edit/{id}', 'DirektoratController@edit');
	Route::post('update/{id}', 'DirektoratController@update');
	Route::post('delete/{id}', 'DirektoratController@destroy');
	Route::get('show/{id}', 'DirektoratController@show');
});


Route::group(['prefix' => 'anggaran'], function() {
	Route::get('/', ['as' => 'anggaran', 'uses' => 'AnggaranController@index']);
	Route::get('tambah', 'AnggaranController@create');
	Route::post('store', 'AnggaranController@store');
	Route::get('edit/{id}', 'AnggaranController@edit');
	Route::post('update/{id}', 'AnggaranController@update');
	Route::post('delete/{id}', 'AnggaranController@destroy');
});

Route::group(['prefix' => 'kompetensi'], function() {
	Route::get('/', ['as' => 'kompetensi', 'uses' => 'KompetensiController@index']);
	Route::get('tambah', 'KompetensiController@create');
	Route::post('store', 'KompetensiController@store');
	Route::get('edit/{id}', 'KompetensiController@edit');
	Route::post('update/{id}', 'KompetensiController@update');
	Route::post('delete/{id}', 'KompetensiController@destroy');
});

Route::group(['prefix' => 'departemen'], function() {
	Route::get('/', ['as' => 'departemen', 'uses' => 'DepartemenController@index']);
	Route::get('tambah', 'DepartemenController@create');
	Route::post('store', 'DepartemenController@store');
	Route::get('edit/{id}', 'DepartemenController@edit');
	Route::post('update/{id}', 'DepartemenController@update');
	Route::post('delete/{id}', 'DepartemenController@destroy');
	Route::get('show/{id}', 'DepartemenController@show');
	Route::get('tambahKompetensi', 'DepartemenController@tambahKompetensi');
	Route::post('storeKompetensi/{id}', 'DepartemenController@storeKompetensi');
	Route::get('editKompetensi/{iddept}/{id}', 'DepartemenController@editKompetensi');
	Route::post('updateKompetensi/{iddept}/{id}', 'DepartemenController@updateKompetensi');
	Route::post('deleteKompetensi/{id}', 'DepartemenController@destroyKompetensi');
});

Route::group(['prefix' => 'training'], function() {
	Route::get('/', ['as' => 'training', 'uses' => 'TrainingController@index']);
	Route::get('tambah', 'TrainingController@create');
	Route::post('store', 'TrainingController@store');
	Route::get('edit/{id}', 'TrainingController@edit');
	Route::post('update/{id}', 'TrainingController@update');
	Route::post('delete/{id}', 'TrainingController@destroy');
});

Route::group(['prefix' => 'divisi'], function() {
	Route::get('/', ['as' => 'divisi', 'uses' => 'DivisiController@index']);
	Route::get('tambah', 'DivisiController@create');
	Route::post('store', 'DivisiController@store');
	Route::get('edit/{id}', 'DivisiController@edit');
	Route::post('update/{id}', 'DivisiController@update');
	Route::post('delete/{id}', 'DivisiController@destroy');
	Route::get('show/{id}', 'DivisiController@show');
});

Route::group(['prefix' => 'rekapitulasiTraining'], function() {
	Route::get('/', ['as' => 'rekapitulasiTraining', 'uses' => 'RekapitulasiTrainingController@index']);
	Route::get('tambah', 'RekapitulasiTrainingController@create');
	Route::post('store', 'RekapitulasiTrainingController@store');
	Route::get('edit/{id}', 'RekapitulasiTrainingController@edit');
	Route::post('update/{id}', 'RekapitulasiTrainingController@update');
	Route::post('delete/{id}', 'RekapitulasiTrainingController@destroy');
	Route::get('show/{id}', 'RekapitulasiTrainingController@show');
	Route::post('storeTanggal/{id}', 'RekapitulasiTrainingController@storeTanggal');
	Route::post('deleteTanggal/{id}', 'RekapitulasiTrainingController@destroyTanggal');
	Route::post('rekapPeserta', 'RekapitulasiTrainingController@rekapPeserta');
});

Route::get('rekapPeserta', ['as' => 'rekapPeserta', 'uses' => 'RekapPesertaController@index']);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

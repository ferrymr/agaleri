<?php

Route::get('/keluar_bb', 'GudangController@keluar_bb')->name('keluar_bb');
Route::post('/keluar_bb', 'GudangController@keluar_bb_create')->name('keluar_bb.create');
Route::get('/keluar_bb_api', 'GudangController@keluar_bb_api')->name('keluar_bb.api');

Route::get('/stock_bb', 'GudangController@stock_bb')->name('stock_bb');
Route::get('/stock_bb_api', 'GudangController@stock_bb_api')->name('stock_bb.api');
Route::get('/stock_bb_kartu_persediaan_api', 'GudangController@stock_bb_kartu_persediaan_api')->name('stock_bb_kartu_persediaan.api');

Route::get('/keluar_acc', 'GudangController@keluar_acc')->name('keluar_acc');
Route::post('/keluar_acc', 'GudangController@keluar_acc_create')->name('keluar_acc.create');
Route::get('/keluar_acc_api', 'GudangController@keluar_acc_api')->name('keluar_acc.api');

Route::get('/stock_acc', 'GudangController@stock_acc')->name('stock_acc');
Route::get('/stock_acc_api', 'GudangController@stock_acc_api')->name('stock_acc.api');
Route::get('/stock_acc_kartu_persediaan_api', 'GudangController@stock_acc_kartu_persediaan_api')->name('stock_acc_kartu_persediaan.api');

Route::get('/stock_bj', 'GudangController@stock_bj')->name('stock_bj');
Route::get('/stock_bj_api', 'GudangController@stock_bj_api')->name('stock_bj.api');

Route::get('stock_print', 'GudangController@stock_print');
Route::post('stock_print/{$param}', 'GudangController@stock_print');

Route::post('get_detail_permintaan_bb', 'GudangController@get_detail_permintaan_bb')->name('detail_permintaan_bb.get');
Route::post('get_detail_permintaan_acc', 'GudangController@get_detail_permintaan_acc')->name('detail_permintaan_acc.get');
Route::post('get_detail_retur_bb', 'GudangController@get_detail_retur_bb')->name('detail_retur_bb.get');
Route::post('get_detail_retur_acc', 'GudangController@get_detail_retur_acc')->name('detail_retur_acc.get');
 
// Retur Bahan Baku Gudang
Route::get('retur_bb_gudang', 'GudangController@retur_bb_index');
Route::get('get_pemakaian_bb_gudang', 'GudangController@get_pemakaian_bb');
Route::post('retur_bb_gudang','GudangController@retur_bb_create')->name('retur_bb_gudang.create');
Route::get('retur_bb/api_gudang','GudangController@retur_bb_api')->name('retur_bb_gudang.api');
Route::post('get_detail_retur_bb_gudang', 'GudangController@get_detail_retur_bb_gudang')->name('detail_retur_bb_gudang.get');

// Retur Accessories
Route::get('retur_acc_gudang', 'GudangController@retur_acc_index');
Route::get('get_pemakaian_acc_gudang', 'GudangController@get_pemakaian_acc');
Route::post('retur_acc_gudang','GudangController@retur_acc_create')->name('retur_acc.create');
Route::get('retur_acc/api_gudang','GudangController@retur_acc_api')->name('retur_acc.api');
Route::post('get_detail_retur_acc_gudang', 'GudangController@get_detail_retur_acc_gudang')->name('detail_retur_acc_gudang.get');


Route::get('/masuk_barang_index', 'GudangController@masuk_barang_index')->name('masuk_barang.index');
Route::get('/masuk_barang_form', 'GudangController@masuk_barang_form')->name('masuk_barang_form.index');
Route::post('/masuk_barang_create', 'GudangController@masuk_barang_create')->name('masuk_barang.create');
Route::get('/masuk_barang/api', 'GudangController@masuk_barang_api')->name('masuk_barang.api'); 


Route::get('/stok_produk', 'GudangController@stok_produk_index')->name('stok_produk.index');
Route::get('/stok_produk/api', 'GudangController@stok_produk_api')->name('stok_produk.api'); 

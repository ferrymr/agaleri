<?php

// Permintaan Bahan Baku
Route::get('permintaan_bb', 'ProduksiController@permintaan_bb_index');
Route::post('permintaan_bb','ProduksiController@permintaan_bb_create')->name('permintaan_bb.create');
Route::get('permintaan_bb/api','ProduksiController@permintaan_bb_api')->name('permintaan_bb.api');
 
// Permintaan Accessories
Route::get('permintaan_acc', 'ProduksiController@permintaan_acc_index');
Route::get('permintaan_acc/api','ProduksiController@permintaan_acc_api')->name('permintaan_acc.api');
Route::post('permintaan_acc','ProduksiController@permintaan_acc_create')->name('permintaan_acc.create');

// Pemakaian Bahan Baku
Route::get('pemakaian_bb', 'ProduksiController@pemakaian_bb_index');
Route::get('get_permintaan_bb', 'ProduksiController@get_permintaan_bb');
Route::post('pemakaian_bb','ProduksiController@pemakaian_bb_create')->name('pemakaian_bb.create');
Route::post('pemakaian_bb_update','ProduksiController@pemakaian_bb_update')->name('pemakaian_bb.update');
Route::get('pemakaian_bb/api','ProduksiController@pemakaian_bb_api')->name('pemakaian_bb.api');
Route::get('pemakaian_bb_so/api','ProduksiController@pemakaian_bb_so_api')->name('pemakaian_bb_so.api');

// Pemakaian Accessoris 
Route::get('pemakaian_acc', 'ProduksiController@pemakaian_acc_index');
Route::get('get_permintaan_acc', 'ProduksiController@get_permintaan_acc');
Route::post('pemakaian_acc','ProduksiController@pemakaian_acc_create')->name('pemakaian_acc.create');
Route::get('pemakaian_acc/api','ProduksiController@pemakaian_acc_api')->name('pemakaian_acc.api');
Route::get('pemakaian_acc_so/api','ProduksiController@pemakaian_acc_so_api')->name('pemakaian_acc_so.api');

// Posting Art ke penyerian
Route::post('posting_art', 'ProduksiController@posting_art');

// Retur Bahan Baku
Route::get('retur_bb', 'ProduksiController@retur_bb_index');
Route::get('get_pemakaian_bb', 'ProduksiController@get_pemakaian_bb');
Route::post('retur_bb','ProduksiController@retur_bb_create')->name('retur_bb.create');
Route::get('retur_bb/api','ProduksiController@retur_bb_api')->name('retur_bb.api');

// Retur Acc
Route::get('retur_acc', 'ProduksiController@retur_acc_index');
Route::get('get_pemakaian_acc', 'ProduksiController@get_pemakaian_acc');
Route::post('retur_acc','ProduksiController@retur_acc_create')->name('retur_acc.create');
Route::get('retur_acc/api','ProduksiController@retur_acc_api')->name('retur_acc.api');
 
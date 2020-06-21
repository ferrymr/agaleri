<?php
// Penyerian
Route::post('/get_art', 'GeneralController@get_art_penyerian')->name('get_art.penyerian');

Route::get('/get_so', 'GeneralController@get_so');
Route::get('/get_so_id_history', 'GeneralController@get_so_id_history');
Route::get('/get_art_id_history', 'GeneralController@get_art_id_history');
Route::post('/get_detail_so', 'GeneralController@get_detail_so'); // For Permintaan Bahan Baku
Route::get('/get_so_fob', 'GeneralController@get_so_fob');
Route::post('/get_so_fob_detail', 'GeneralController@get_so_fob_detail'); 
Route::post('/get_so_nama', 'GeneralController@get_so_nama');
Route::get('/get_art', 'GeneralController@get_art');
Route::get('/get_produksi', 'GeneralController@get_produksi'); 
Route::get('/get_retur', 'GeneralController@get_retur');
Route::get('/get_so_masuk', 'GeneralController@get_so_masuk');
Route::get('/get_faktur_hutang', 'GeneralController@get_faktur_hutang');
Route::get('/get_skb_hutang', 'GeneralController@get_skb_hutang');
Route::post('/get_data_hutang', 'GeneralController@get_data_hutang');

Route::get('/get_akun', 'GeneralController@get_akun');
Route::get('/get_proses', 'GeneralController@get_proses');
Route::get('/get_cmt', 'GeneralController@get_cmt');
Route::get('/get_e_kategori', 'GeneralController@get_e_kategori');
Route::get('/get_e_produk', 'GeneralController@get_e_produk');
Route::get('/get_size', 'GeneralController@get_size');
Route::get('/get_master_bb', 'GeneralController@get_master_bb');
Route::get('/get_bb', 'GeneralController@get_bb');
Route::get('/get_acc', 'GeneralController@get_acc');
Route::get('/get_bj', 'GeneralController@get_bj');
Route::get('/get_master_bj', 'GeneralController@get_master_bj');
Route::get('/get_detail_master_bj', 'GeneralController@get_detail_master_bj');
Route::get('/get_warna', 'GeneralController@get_warna');
Route::get('/get_role', 'GeneralController@get_role');
Route::get('/get_brand', 'GeneralController@get_brand');
Route::get('/get_supplier', 'GeneralController@get_supplier');
Route::get('/get_satuan', 'GeneralController@get_satuan');
Route::get('/get_permintaan_bb', 'GeneralController@get_permintaan_bb');
Route::get('/get_keluar_bb', 'GeneralController@get_keluar_bb');
Route::get('/get_permintaan_acc', 'GeneralController@get_permintaan_acc');


// GET HARGA BB DEFAULT
Route::post('/get_harga_bb_default', 'GeneralController@get_harga_bb_default');
Route::post('/get_harga_acc_default', 'GeneralController@get_harga_acc_default');

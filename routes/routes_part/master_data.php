<?php

//Master Bahan Baku Routes
Route::get('/bahan_baku', 'MasterDataController@bahan_baku');
Route::post('/add_bahan_baku', 'MasterDataController@add_bahan_baku');
Route::post('/update_bahan_baku', 'MasterDataController@update_bahan_baku');
Route::post('/del_bahan_baku', 'MasterDataController@del_bahan_baku');

//Master Warna Routes
Route::get('/warna', 'MasterDataController@warna');
Route::post('/add_warna', 'MasterDataController@add_warna');
Route::post('/update_warna', 'MasterDataController@update_warna');
Route::post('/del_warna', 'MasterDataController@del_warna');

//Master Brand Routes
Route::get('/brand', 'MasterDataController@brand');
Route::post('/add_brand', 'MasterDataController@add_brand');
Route::post('/update_brand', 'MasterDataController@update_brand');
Route::post('/del_brand', 'MasterDataController@del_brand');

//Master Satuan Routes
Route::get('/satuan', 'MasterDataController@satuan');
Route::post('/add_satuan', 'MasterDataController@add_satuan');
Route::post('/update_satuan', 'MasterDataController@update_satuan');
Route::post('/del_satuan', 'MasterDataController@del_satuan');

//Master Barang Jadi Routes
Route::get('/barang_jadi', 'MasterDataController@barang_jadi');
Route::post('/add_barang_jadi', 'MasterDataController@add_barang_jadi');
Route::post('/update_barang_jadi', 'MasterDataController@update_barang_jadi');
Route::post('/del_barang_jadi', 'MasterDataController@del_barang_jadi');

//Master Supplier Routes
Route::get('supplier', 'MasterDataController@supplier');
Route::post('supplier_create', 'MasterDataController@supplier_create');
Route::get('supplier/{id}/edit','MasterDataController@supplier_edit')->name('supplier.edit');
Route::post('supplier_update', 'MasterDataController@supplier_update');
Route::post('supplier_delete', 'MasterDataController@supplier_delete');
Route::get('supplier/api','MasterDataController@supplier_api')->name('supplier.api');

//Master Costumer Routes
Route::get('costumer', 'MasterDataController@costumer');
Route::post('costumer_create', 'MasterDataController@costumer_create');
Route::get('costumer/{id}/edit','MasterDataController@costumer_edit')->name('costumer.edit');
Route::post('costumer_update', 'MasterDataController@costumer_update');
Route::post('costumer_delete', 'MasterDataController@costumer_delete');
Route::get('costumer/api','MasterDataController@costumer_api')->name('costumer.api');

//Master CMT Routes
Route::get('cmt', 'MasterDataController@cmt');
Route::post('cmt_create', 'MasterDataController@cmt_create');
Route::get('cmt/{id}/edit','MasterDataController@cmt_edit')->name('cmt.edit');
Route::post('cmt_update', 'MasterDataController@cmt_update');
Route::post('cmt_delete', 'MasterDataController@cmt_delete');
Route::get('cmt/api','MasterDataController@cmt_api')->name('cmt.api');

//Master Accessories Routes
Route::get('/acc', 'MasterDataController@acc');
Route::post('/add_acc', 'MasterDataController@add_acc');
Route::post('/update_acc', 'MasterDataController@update_acc');
Route::post('/del_acc', 'MasterDataController@del_acc');

//Master Proses Routes
Route::get('/proses', 'MasterDataController@proses');
Route::post('/add_proses', 'MasterDataController@add_proses');
Route::post('/update_proses', 'MasterDataController@update_proses');
Route::post('/del_proses', 'MasterDataController@del_proses');

//Master Bank Routes
Route::get('/bank', 'MasterDataController@bank');
Route::post('/add_bank', 'MasterDataController@add_bank');
Route::post('/update_bank', 'MasterDataController@update_bank');
Route::post('/del_bank', 'MasterDataController@del_bank');

// Route Role
Route::get('role','MasterDataController@role_index')->name('role.index');
Route::get('role/api','MasterDataController@role_api')->name('role.api');
Route::post('role','MasterDataController@role_create')->name('role.create');
Route::get('role/{id}/edit','MasterDataController@role_edit')->name('role.edit');
Route::patch('role/{id}','MasterDataController@role_update')->name('role.update');
Route::delete('role/{id}','MasterDataController@role_delete')->name('role.delete');

// Route Role
Route::get('master_neraca_saldo', 'MasterDataController@master_neraca_saldo_index')->name('master_neraca_saldo.index');
Route::get('master_neraca_saldo/api', 'MasterDataController@master_neraca_saldo_api')->name('master_neraca_saldo.api');
Route::post('master_export_neraca_saldo', 'MasterDataController@master_export_neraca_saldo')->name('master_export.neraca_saldo');
Route::post('insert_neraca_saldo', 'MasterDataController@insert_neraca_saldo')->name('insert.neraca_saldo');
